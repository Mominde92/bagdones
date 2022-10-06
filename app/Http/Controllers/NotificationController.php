<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use App\Models\Order;
use App\Services\FCMService;
use App\Models\Item;


class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        return view('orders.sendtoallnotification');

    }

    public function itemnotification(Request $request)
    {
        $Items = Item::get();
        return view('orders.itemnotification',compact('Items'));

    }

    public function senditemnotification(Request $request)
    {
        $orders = Order::select('device_token')->distinct()->get();
        $item = item::where('id',$request->item_id)->first();
       
        foreach($orders as $order)
        {
            $this->sendItemn($order->device_token,'item',$item);
        }
         
        return redirect()->route('itemnotification');
    }



    public function specificnotification(Request $request)
    {
        $orders = Order::get();
        return view('orders.specificnotification',compact('orders'));
        
    }

    public function sendspecificnotification(Request $request)
    {
        $orders = Order::select('device_token')->distinct()->get();
        $item = item::where('id',$request->item)->first();
       
        foreach($orders as $order)
        {
            $this->sendNotificationToAll($order->device_token,'',$item,'','','','',$request->notification_type);
        }
         
        return redirect()->route('itemnotification');
    }



    public function sendNotification(Request $request)
    {
        $orders = Order::select('device_token')->distinct()->get();
        $input['image_path'] = '';

        if ($image_path = $request->file('image_path')) {
            $destinationPath = 'uploads/notification/';
            $recordImage =  time(). "." . $image_path->getClientOriginalExtension();
            $image_path->move($destinationPath, $recordImage);
            $input['image_path'] = "$recordImage";
        }

        foreach($orders as $order)
        {
            $this->sendNotificationToAll($order->device_token,$request->title,$request->body,$request->title_locale,$request->description_locale,'',asset('/uploads/notification/'.$input['image_path']),'normal');
        }
         
        return asset('/uploads/notification/'.$input['image_path']);
    }

    public static function sendNotificationToAll($to,$title=null,$body=null,$title_locale = null,$description_locale = null,$order_id = null ,$image_path ='https://www.bagdones.com/app/media/logos/bagdones_logo.png',$notification_type)
    {
        $apiUrl=config('appGlobal.pushNotificationApiUrl');
        $headers=config('appGlobal.pushNotificationHeaders');
   if(empty($image_path))
   {
   $image_path ='https://www.bagdones.com/app/media/logos/bagdones_logo.png';
   }
        FCMService::send(
            $to,
          [
            'title_en' => $title,
            'description_en' => $body,
            'title_locale' => $title_locale,
            'description_locale' => $description_locale,
            'order_id'=>$order_id,
            "notification_type"=>$notification_type,
            "image_path"=>$image_path,
           
          ]
  
      );
    
    }

    public static function sendItemn($to,$notification_type,$item)
    {
            
            $item->image = asset('uploads/items/' . $item->image);
            $item->main_screen_image = asset('uploads/items/' . $item->main_screen_image);
            $item->cover_image = asset('uploads/items/' . $item->cover_image);
       
        FCMService::send(
            $to,
            
          [
            "item"=>$item,
            "notification_type"=>$notification_type,
           
          ]
            
      );

      



}
}