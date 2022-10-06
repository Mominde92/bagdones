<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;
use App\Models\OrderItems;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use App\Services\FCMService;

class OrderApiController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // echo json_encode($request->all());
        // exit;
        DB::beginTransaction();
        try{
            //create order and get order id
            $order = new Order();
            // $order->order_number = uniqid('ORD.');
            // $order->user_id = $request->user_id;

            $order->city = $request->city;
            $order->area = $request->area;

            $order->amount = floatval($request->amount);
            $order->tax = floatval($request->tax);
            $order->delivery_fee = floatval($request->delivery_fee);
            $order->total_amount = floatval($request->total_amount);

            $order->street_n = $request->street_n;
            $order->building_n = $request->building_n;
            $order->floor_n = $request->floor_n;
            $order->appartment_n = $request->appartment_n;

            $order->phone_number = $request->phone_number;
            $order->gps_link = $request->gps_link;
            $order->device_type = $request->device_type;
            $order->device_token = $request->device_token;
            $order->customer_note = $request->customer_note;
            
            $order->save();

            $items = $request->items;
            foreach($items as $item){
            
                $item['item_id'] = intval($item['item_id']);
                $item['quantity'] = floatval($item['quantity']);
                $item['unit_price'] = floatval($item['unit_price']);
                $item['order_id'] = $order->id;
                OrderItems::create($item);
            }

            DB::commit();
            app('App\Http\Controllers\NotificationController')::sendNotificationToAll($order->device_token,'shopping successfully','Thank for your shopping , order number :'.$order->id,'تم التسوق بنجاح',$order->id.'شكرا للتسوق رقم طلبك',$order->id,'https://www.bagdones.com/app/uploads/notification/shopping-bag.png','order');


            // $this->sendNotificationrToUser($order->device_token , $order);
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
            return $this->sendError($e);
        }
        return $this->sendResponse($order, 'Order created successfully.');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($order)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function sendNotificationrToUser($device_token,$order)
    {
       // get a user to get the fcm_token that already sent.               from mobile apps 
    //    $user = User::findOrFail($id);
        if($device_token==null ||  $device_token == '' ){
            return;
        }

      FCMService::send(
          $device_token,
          [
              'title' => 'New order',
              'body' => 'Your order sent successfully',
              'order_id'=>$order->id
          ]
         
      );
    }

    public function order_details(Request $request)
    {
        $Language = $request->header('Accept-Language');
      
        if($Language =='en')
        {
            $data['order'] = Order::where('orders.id',$request->order_id)
            ->leftjoin('order_items', 'order_items.order_id', '=', 'orders.id')
            ->leftjoin('items', 'items.id', '=', 'order_items.item_id')
            ->leftjoin('stores', 'stores.id', '=', 'items.store_id')
            ->select('orders.id as order_number',\DB::raw('DATE_FORMAT(fs_orders.created_at, "%Y-%m-%d") as order_date'),\DB::raw('DATE_FORMAT(fs_orders.created_at, "%H:%i") as time'),'orders.amount','orders.tax','orders.delivery_fee','orders.total_amount',
            \DB::raw('(CASE 
            WHEN fs_orders.deliverd = "1" THEN "deliverd" 
            WHEN fs_orders.in_delivery = "1" THEN "in_delivery" 
            WHEN fs_orders.in_process = "1" THEN "in_process" 
            WHEN fs_orders.recived = "1" THEN "recived" 
            ELSE "Shoping" 
            END) AS order_status')
            ,'orders.area',(DB::raw("CONCAT(fs_orders.street_n,fs_orders.building_n,fs_orders.floor_n,fs_orders.appartment_n) AS specific_address")),'orders.phone_number as customer_mobile'
            ,'stores.name as store_name','stores.phone_number as store_phone_number','stores.delivery_time_range',(DB::raw("CONCAT('https://zee-fashion.com/uploads/stores/',fs_stores.image) AS store_image")))->first();
    
            $data['order']['item'] = OrderItems::where('order_items.order_id',$request->order_id)->leftjoin('items', 'items.id', '=', 'order_items.item_id')
            ->select('items.name','order_items.quantity')->get();
        }
        else
        {
            $data['order'] = Order::where('orders.id',$request->order_id)
            ->leftjoin('order_items', 'order_items.order_id', '=', 'orders.id')
            ->leftjoin('items', 'items.id', '=', 'order_items.item_id')
            ->leftjoin('stores', 'stores.id', '=', 'items.store_id')
            ->select('orders.id as order_number',\DB::raw('DATE_FORMAT(fs_orders.created_at, "%Y-%m-%d") as order_date'),\DB::raw('DATE_FORMAT(fs_orders.created_at, "%H:%i") as time'),'orders.amount','orders.tax','orders.delivery_fee','orders.total_amount',
            \DB::raw('(CASE 
                        WHEN fs_orders.deliverd = "1" THEN "deliverd" 
                        WHEN fs_orders.in_delivery = "1" THEN "in_delivery" 
                        WHEN fs_orders.in_process = "1" THEN "in_process" 
                        WHEN fs_orders.recived = "1" THEN "recived" 
                        ELSE "Shoping" 
                        END) AS order_status'),
            'orders.area',(DB::raw("CONCAT(fs_orders.street_n,fs_orders.building_n,fs_orders.floor_n,fs_orders.appartment_n) AS specific_address")),'orders.phone_number as customer_mobile'
            ,'stores.name_locale','stores.phone_number as store_phone_number','stores.delivery_time_range',
            (DB::raw("CONCAT('https://zee-fashion.com/uploads/stores/',fs_stores.image) AS store_image"))
            )->first();
    
            $data['order']['item'] = OrderItems::where('order_items.order_id',$request->order_id)->leftjoin('items', 'items.id', '=', 'order_items.item_id')
            ->select('items.name_locale','order_items.quantity')->get();
        }
      

        return $this->sendResponse($data, 'order retrieved successfully.');
    }
}
