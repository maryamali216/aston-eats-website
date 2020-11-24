<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use Session;
use Image;
use App\Category;
use App\Item;
use App\ItemsAttribute;
use DB;
use App\User;
use App\Delivery;
use App\Order;
use App\OrdersItem;

class ItemsController extends Controller
{
    public function addItem(Request $request){

        if($request->isMethod('post')){
            $data = $request->all();

            if(empty($data['category_id'])){
                return redirect()->back()->with('flash_message_error','Category is Missing!');
            }
            $item = new Item;
            $item->category_id = $data['category_id'];
            $item->item_name=$data['item_name'];
            $item->item_code=$data['item_code'];
            $item->company=$data['company'];
            $item->description=$data['description'];
            $item->price=$data['price'];

            //Upload the image
            if($request->hasFile('image')){
                $image_tmp = Input::file('image');
                if($image_tmp->isValid()){
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).".".$extension;
                    $large_image_path = 'images/backend_images/items/large/'.$filename;
                    $medium_image_path = 'images/backend_images/items/medium/'.$filename;
                    $small_image_path = 'images/backend_images/items/small/'.$filename;

                    //Resize the image
                    Image::make($image_tmp)->resize(1200,1200)->save($large_image_path);
                    Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
                    Image::make($image_tmp)->resize(300,300)->save($small_image_path);

                    //Store the image name in table
                    $item->image=$filename;
                }
            }

            $item->save();
            return redirect('/admin/view-items')->with('flash_message_success','Item has been added Successfully!');
        }

        $categories = Category::where(['parent_id'=>0])->get();
        $categories_dropdown = "<option selected disabled>Select</option>";
        foreach ($categories as $cat){
            $categories_dropdown.= "<option value='".$cat->id."'>".$cat->name."</option>";
            $sub_categories = Category::where(['parent_id'=>$cat->id])->get();
            foreach ($sub_categories as $sub_cat) {
                $categories_dropdown .= "<option value = '".$sub_cat->id."'>&nbsp;--&nbsp;".$sub_cat->name."</option>";
            }
        }
        return view('admin.items.add_item')->with(compact('categories_dropdown'));
    }

    public function editItem(Request $request, $id=null){

        if($request->isMethod('post')){
            $data = $request->all();

            if($request->hasFile('image')){
                $image_tmp = Input::file('image');
                if($image_tmp->isValid()) {
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111, 99999) . "." . $extension;
                    $large_image_path = 'images/backend_images/items/large/' . $filename;
                    $medium_image_path = 'images/backend_images/items/medium/' . $filename;
                    $small_image_path = 'images/backend_images/items/small/' . $filename;
                    //Resize the image
                    Image::make($image_tmp)->resize(1200, 1200)->save($large_image_path);
                    Image::make($image_tmp)->resize(600, 600)->save($medium_image_path);
                    Image::make($image_tmp)->resize(300, 300)->save($small_image_path);
                }
            } else if (!empty($data['current_image'])){
                $filename = $data['current_image'];
            } else{
                $filename='';
            }

            Item::where(['id'=>$id])->update(['category_id'=>$data['category_id'],'item_name'=>$data['item_name'],'item_code'=>$data['item_code'],
                'company'=>$data['company'],'description'=>$data['description'],'price'=>$data['price'],'image'=>$filename]);
            return redirect()->back()->with('flash_message_success','Item has been updated Successfully!');
        }

        $itemDetails = Item::where(['id'=>$id])->first();

        $categories = Category::where(['parent_id'=>0])->get();
        $categories_dropdown = "<option value='' selected disabled>Select</option>";
        foreach ($categories as $cat){
            if($cat->id==$itemDetails->category_id){
                $selected = "selected";
            } else {
                $selected = "";
            }
            $categories_dropdown.= "<option value='".$cat->id."' ".$selected.">".$cat->name."</option>";
            $sub_categories = Category::where(['parent_id'=>$cat->id])->get();
            foreach ($sub_categories as $sub_cat) {
                if($sub_cat->id==$itemDetails->category_id){
                    $selected = "selected";
                } else {
                    $selected = "";
                }
                $categories_dropdown .= "<option value = '".$sub_cat->id."' ".$selected.">&nbsp;--&nbsp;".$sub_cat->name."</option>";
            }
        }

        return view('admin.items.edit_item')->with(compact('itemDetails','categories_dropdown'));
    }

    public function viewItems(){
        $items = Item::get();
        //Get name of category from category database
        //foreach($items as $key => $val) {
          //  $category_name = Category::where(['id'=>$val->category_id])->first();
            //$items[$key]->category_name = $category_name->name;
        //}

        $items = json_decode(json_encode($items));
        return view('admin.items.view_items')->with(compact('items'));
    }

    public function deleteItem($id=null){
        Item::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success','Item has been deleted Successfully!');
    }

    public function deleteItemImage($id=null){
        Item::where(['id'=>$id])->update(['image'=>'']);
        return redirect()->back()->with('flash_message_success','Item Image has been deleted Successfully!');
    }

    public function addAttributes(Request $request, $id=null) {
        $itemDetails = Item::with('attributes')->where(['id'=>$id])->first();
        //$itemDetails = json_decode(json_encode($itemDetails));

        if($request->isMethod('post')){
            $data = $request->all();

            foreach ($data['sku'] as $key => $val){
                if(!empty($val)){

                    //sku check
                    $attrCountSKU = ItemsAttribute::where('sku',$val)->count();
                    if($attrCountSKU>0){
                        return redirect('admin/add-attributes/'.$id)->with('flash_message_error','SKU already exists! Please add another.');
                    }
                    $attrCountSizes = ItemsAttribute::where(['item_id'=>$id,'size'=>$data['size'][$key]])->count();
                    if($attrCountSizes>0) {
                        return redirect('admin/add-attributes/' . $id)->with('flash_message_error', 'Attribute already exists. Please add another.');
                    }
                    $attribute = new ItemsAttribute;
                    $attribute->item_id = $id;
                    $attribute->sku = $val;
                    $attribute->size = $data['size'][$key];
                    $attribute->allergens = $data['allergens'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->save();
                }
            }

            return redirect('admin/add-attribute/'.$id)->with('flash_message_success','Item Attributes Successfully Added!');
        }
        return view('admin.items.add_attributes')->with(compact('itemDetails'));
    }

    public function deleteAttribute($id=null){
        ItemsAttribute::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success','Item has been deleted Successfully!');
    }

    public function items($url = null) {

        //show 404 page
        $countCategory = Category::where(['url'=>$url])->count();
        if($countCategory==0){
            abort(404);
        }

        $categories = Category::with('categories')->where(['parent_id'=>0])->get();

        $categoryDetails = Category::where(['url'=>$url])->first();

        if($categoryDetails->parent_id==0){
           $subCategories = Category::where(['parent_id'=>$categoryDetails->id])->get();
           foreach ($subCategories as $subcat){
                $cat_ids[] = $subcat->id;
            }
            $itemsAll = Item::whereIn('category_id',$cat_ids)->get();
            $itemsAll = json_decode(json_encode($itemsAll));
        }else{
            $itemsAll = Item::where(['category_id'=> $categoryDetails->id])->get();
        }
        return view('items')->with(compact('categories','categoryDetails','itemsAll'));

    }

    public function item($id = null){

        $itemDetails = Item::with('attributes')->where('id',$id)->first();

        $itemDetails = json_decode(json_encode($itemDetails));
        //echo"<pre>"; print_r($itemDetails); die;

        $categories = Category::with('categories')->where(['parent_id' => 0])->get();

        $total_stock = ItemsAttribute::where('item_id',$id)->sum('stock');

        return view('detail')->with(compact('itemDetails','categories','total_stock'));
    }

    public function getItemPrice(Request $request){
        $data = $request->all();
        $proArr = explode("-",$data['idSize']);
        $proArr = ItemsAttribute::where(['item_id'=> $proArr[0], 'size'=> $proArr[1]])->first();
        echo $proArr->price;
        echo "#";
        echo $proArr->stock;
    }

    public function addToBasket(Request $request){
        $data = $request->all();
        //echo"<pre>"; print_r($data); die;

        if(empty(Auth::user()->email)){
            $data['user_email'] = '';
        }else{
            $data['user_email'] = Auth::user()->email;
        }

        $session_id = Session::get('session_id');
        if(!isset($session_id)){
            $session_id = str_random(40);
            Session::put('session_id',$session_id);
        }

        $sizeArr = explode("-",$data['size']);

        $countItems = DB::table('basket')->where(['item_id' => $data['item_id'],'company' => $data['company'],'size' => $sizeArr[1],'session_id' => $session_id])->count();
        if($countItems>0){
            return redirect()->back()->with('flash_message_error','Item already exists in Basket!');
        }else{

            $getSKU = ItemsAttribute::select('sku')->where(['item_id' => $data['item_id'], 'size' => $sizeArr[1]])->first();

            DB::table('basket')->insert(['item_id' => $data['item_id'],'item_name' => $data['item_name'],
                'item_code' => $data['item_code'],'company' => $data['company'],
                'price' => $data['price'],'size' => $sizeArr[1],'quantity' => $data['quantity'],
                'user_email' => $data['user_email'],'session_id' => $session_id]);

        }

        return redirect('basket')->with('flash_message_success','Item has been added to Basket!');
    }

    public function basket(){
        if(Auth::check()){
            $user_email = Auth::user()->email;
            $userBasket = DB::table('basket')->where(['user_email' => $user_email])->get();
        }else{
            $session_id = Session::get('session_id');
            $userBasket = DB::table('basket')->where(['session_id' => $session_id])->get();
        }

        foreach($userBasket as $key => $item){
            $itemDetails = Item::where('id',$item->item_id)->first();
            $userBasket[$key]->image=$itemDetails->image;
        }
        //echo "<pre>"; print_r($userBasket);
        return view('basket')->with(compact('userBasket'));
    }

    public function deleteBasketItem($id=null){
        DB::table('basket')->where('id',$id)->delete();
        return redirect('basket')->with('flash_message_success','Item has been deleted in Basket!');
    }

    public function updateBasketQuantity($id=null,$quantity=null){
        DB::table('basket')->where('id',$id)->increment('quantity',$quantity);
        return redirect('basket')->with('flash_message_success','Item Quantity has been updated in Basket!');
    }

    public function checkout(Request $request){
        $user_id = Auth::user()->id;
        $user_email = Auth::user()->email;
        $userDetails = User::find($user_id);

        //Check if Shipping Address exists
        $shippingCount = Delivery::where('user_id',$user_id)->count();
        $shippingDetails = array();
        if($shippingCount>0){
            $shippingDetails = Delivery::where('user_id',$user_id)->first();
        }

        // Update cart table with user email
        $session_id = Session::get('session_id');
        DB::table('basket')->where(['session_id'=>$session_id])->update(['user_email'=>$user_email]);
        if($request->isMethod('post')){
            $data = $request->all();
            /*echo "<pre>"; print_r($data); die;*/
            // Return to Checkout page if any of the field is empty
            if(empty($data['billing_name']) || empty($data['billing_address']) || empty($data['billing_city']) || empty($data['billing_country']) || empty($data['billing_postcode']) || empty($data['billing_mobile']) || empty($data['shipping_name']) || empty($data['shipping_room']) || empty($data['shipping_floor']) || empty($data['shipping_building']) || empty($data['shipping_mobile'])){
                return redirect()->back()->with('flash_message_error','Please fill all fields to Checkout!');
            }

            // Update User details
            User::where('id',$user_id)->update(['name'=>$data['billing_name'],'address'=>$data['billing_address'],'city'=>$data['billing_city'],'country'=>$data['billing_country'],'postcode'=>$data['billing_postcode'],'mobile'=>$data['billing_mobile']]);

            if($shippingCount>0){
                $shipping = new Delivery;
                $shipping->user_id = $user_id;
                $shipping->user_email = $user_email;
                $shipping->name = $data['shipping_name'];
                $shipping->room = $data['shipping_room'];
                $shipping->floor = $data['shipping_floor'];
                $shipping->building = $data['shipping_building'];
                $shipping->mobile = $data['shipping_mobile'];
            }else{
                // Add New Shipping Address
                $shipping = new Delivery;
                $shipping->user_id = $user_id;
                $shipping->user_email = $user_email;
                $shipping->name = $data['shipping_name'];
                $shipping->room = $data['shipping_room'];
                $shipping->floor = $data['shipping_floor'];
                $shipping->building = $data['shipping_building'];
                $shipping->mobile = $data['shipping_mobile'];
                $shipping->save();
            }

            return redirect()->action('ItemsController@orderReview');
        }

        return view('checkout')->with(compact('userDetails','shippingDetails'));
    }

    public function orderReview() {
        $user_id = Auth::user()->id;
        $user_email = Auth::user()->email;
        $userDetails = User::where('id',$user_id)->first();
        $shippingDetails = Delivery::where('user_id',$user_id)->first();
        $shippingDetails = json_decode(json_encode($shippingDetails));
        $userBasket = DB::table('basket')->where(['user_email' => $user_email])->get();
        foreach($userBasket as $key => $item){
            $itemDetails = Item::where('id',$item->item_id)->first();
            $userBasket[$key]->image = $itemDetails->image;
        }
        /*echo "<pre>"; print_r($userCart); die;*/
        return view('order_review')->with(compact('userDetails','shippingDetails','userBasket'));
    }

    public function placeOrder(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $user_id = Auth::user()->id;
            $user_email = Auth::user()->email;

            // Get Shipping Address of User
            $shippingDetails = Delivery::where(['user_email' => $user_email])->first();

            /*echo "<pre>"; print_r($data); die;*/

            $order = new Order;
            $order->user_id = $user_id;
            $order->user_email = $user_email;
            $order->name = $shippingDetails->name;
            $order->room = $shippingDetails->room;
            $order->floor = $shippingDetails->floor;
            $order->building = $shippingDetails->building;
            $order->mobile = $shippingDetails->mobile;
            $order->order_status = "New";
            $order->payment_method = $data['payment_method'];
            $order->grand_total = $data['grand_total'];
            $order->save();

            $order_id = DB::getPdo()->lastInsertId();

            $basketItems = DB::table('basket')->where(['user_email'=>$user_email])->get();
            foreach($basketItems as $pro){
                $basketPro = new OrdersItem();
                $basketPro->order_id = $order_id;
                $basketPro->user_id = $user_id;
                $basketPro->item_id = $pro->item_id;
                $basketPro->item_code = $pro->item_code;
                $basketPro->item_name = $pro->item_name;
                $basketPro->item_company = $pro->company;
                $basketPro->item_size = $pro->size;
                $basketPro->item_price = $pro->price;
                $basketPro->item_qty = $pro->quantity;
                $basketPro->save();
            }

            Session::put('order_id',$order_id);
            Session::put('grand_total',$data['grand_total']);

            if($data['payment_method']=="Cash"){
                return redirect('/thanks');
            }else {
                return redirect('/paypal');
            }
        }
    }

    public function thanks(Request $request){
        $user_email = Auth::user()->email;
        DB::table('basket')->where('user_email',$user_email)->delete();
        return view('thanks');
    }

    public function paypal(Request $request){
        $user_email = Auth::user()->email;
        DB::table('basket')->where('user_email',$user_email)->delete();
        return view('paypal');
    }

    public function thanksPaypal(){
        return view('thanks_paypal');
    }

    public function userOrders(){
        $user_id = Auth::user()->id;
        $orders = Order::with('orders')->where('user_id',$user_id)->orderBy('id','DESC')->get();
        return view('user_orders')->with(compact('orders'));
    }

    public function userOrderDetails($order_id){
        $user_id = Auth::user()->id;
        $orderDetails = Order::with('orders')->where('id',$order_id)->first();
        $orderDetails = json_decode(json_encode($orderDetails));
        return view('user_order_details')->with(compact('orderDetails'));
    }

    public function viewOrders(){
        $orders = Order::with('orders')->orderBy('id','Desc')->get();
        $orders = json_decode(json_encode($orders));
        return view('admin.items.view_orders')->with(compact('orders'));
    }

    public function viewOrderDetails($order_id){
        $orderDetails = Order::with('orders')->where('id',$order_id)->first();
        $orderDetails = json_decode(json_encode($orderDetails));
        $user_id = $orderDetails->user_id;
        $userDetails = User::where('id',$user_id)->first();
        return view('order_details')->with(compact('orderDetails','userDetails'));
    }

    public function updateOrderStatus(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            Order::where('id',$data['order_id'])->update(['order_status'=>$data['order_status']]);
            return redirect()->back()->with('flash_message_success','Order Status has been updated successfully!');
        }
    }



}
