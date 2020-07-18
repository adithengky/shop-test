<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Repository\Order\OrderRepoInterface;
use App\Repository\Product\ProductRepoInterface;
use App\Repository\User\UserRepoInterface;
use DB;

class OrderController extends Controller
{
    protected $userRepository;
    protected $orderRepository;
    protected $productRepository;

    public function __construct(ProductRepoInterface $productRepository, OrderRepoInterface $orderRepository, UserRepoInterface $userRepository)
    {
        $this->productRepository = $productRepository;
        $this->orderRepository = $orderRepository;
        $this->userRepository = $userRepository;
    }

   public function store(OrderRequest $request) {
        $input = $request->only('name', 'phone', 'address', 'product_id', 'qty');
        $product = $this->productRepository->find('id', $input['product_id']);
        if (!$product) {
            return $this->errorResponse(404, 'Product Not Found');
        }
        $user = $this->userRepository->findByArray(['name' => $input['name'], 'phone' => $input['phone']]);
        
        DB::beginTransaction();
        try {
            if (!$user) {
                $create = $this->userRepository->create([
                    'name' => $input['name'],
                    'phone' => $input['phone'],
                    'address' => $input['address'],
                    'is_admin' => false,
                ]);
                $uid = $create->id;
            } else {
                $uid = $user->id;
            }

            $total = $product->price * $input['qty'];
    
            $save = $this->orderRepository->create([
                'product_id' => $product->id,
                'user_id' => $uid,
                'qty' => $input['qty'],
                'total' => $total,
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return $this->errorResponse(400, $e->getMessage());
        }
        
        return $this->successResponse(200, 'success', [
            'order_id' => $save->id,
            'name' => $product->name,
            'qty' => $input['qty'],
            'total' => $total
        ]);
    }

    public function all() {
        $orders = $this->orderRepository->getDatatableRelation();
        return $this->successResponse(200, 'success', $orders);
    }

    public function delete($id) {
        $order = $this->orderRepository->find('id', $id);
        if (!$order) {
            return $this->errorResponse(404, 'Not Found');
        }
        $result = $this->orderRepository->delete('id', $id);
        return $this->successResponse(200, 'success');
    }

    public function get($id) {
        $order = $this->orderRepository->findWithRelation('id', $id);
        if (!$order) {
            return $this->errorResponse(404, 'Not Found');
        }
        return $this->successResponse(200, 'success', $order);
    }
}
