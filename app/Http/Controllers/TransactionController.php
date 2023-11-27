<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Log as logs;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionItem;
use Illuminate\Support\Facades\Log;

class TransactionController extends Controller
{
    protected $date;
    protected $time;

    public function __construct()
    {
        $this->date = Carbon::now()->toDateString();
        $this->time = Carbon::now()->toTimeString();
    }
    
    public function saveTransaction(Request $request){
        try {
            // Your logic for saving the receipt data goes here.
            // You can access the data sent from the client using $request->getContent()

            // For example, you can decode the JSON data like this:
            $data = json_decode($request->getContent(), true);
            Log::info('data=0', $data[0]);
            $items = $data[0];
            $transaction = $data[1];

            $date = Carbon::parse($transaction['date']); // Convert the date string to a Carbon object
            $time = Carbon::parse($transaction['time']); // Convert the time string to a Carbon object

            $formFields = [
                'transaction_id' => "test",
                'cashier' => $transaction['cashier'],
                'grand_total' => $transaction['grandTotal'],
                'payment' => $transaction['cash'],
                'change' => $transaction['change'],
                'item_count' => $transaction['items'],
                'transaction_date' => $date->toDateString(),
                'transaction_time' => $time->toTimeString()
            ];

            // Perform the necessary operations to save the receipt data.
            $receipt = Transaction::create($formFields);
            // Send a response back to the client.
            // session()->flash('message', 'Transaction Successful');

            $logFields = [
                'user_id' => auth()->user()->id,
                'activity' => 'New Transaction "#' . $receipt->id . '" added',
                'log_date' => $this->date,
                'log_time' => $this->time
            ];
    
            logs::create($logFields);

            //create item
            foreach($items as $item){
                $itemFields = [
                    'transaction_id' => $receipt->id,
                    'product_code' => $item['item_code'],
                    'quantity' => $item['quantity']
                ];
                TransactionItem::create($itemFields);

                // $product = Product::where('code', $item['item_code']);
                // dd($product);
                // $quantity = $product['qty'] - $item['quantity'];

                // $product->update($quantity);
                
            }

            return response()
                ->json(['ok' => true, 'message' => 'Transaction successful']);
        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['ok' => false, 'message' => 'Error saving data']);
        }
    }

    public function readTransaction(){

        $transactions = Transaction::paginate(10);
        return view('admin_pages/sales_pages/sales', ['transactions' => Transaction::all()]);
    }

    public function viewTransaction($id){
        // dd(Transaction::with('transaction_items')->find($id));
        return view('admin_pages/sales_pages/reciept', ['transaction' => Transaction::with('transaction_items')->find($id) ]);
    }
}
