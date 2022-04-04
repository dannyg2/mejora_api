<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Factura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\FacturaResource;
use App\Http\Requests\NuevaFacturaRequest;

class FacturaController extends Controller
{
       
    /**
     * store
     *
     * @param  mixed $nuevaFacturaRequest
     * @return void
     */
    public function store(NuevaFacturaRequest $nuevaFacturaRequest){
        try {
           
            $data = $nuevaFacturaRequest->all();
            $subTotal = 0;
            foreach ($data["items"] as  $item) {
                $subTotal += $item["valor"]*$item["cantidad"];
            }
            $totalIva = 0;
            if($data["iva"] > 0){
                $totalIva = $this->getTotalIva($subTotal,$data["iva"]);
            }
            $data["iva_value"] = $totalIva;
            $data["fecha"] = date("Y-m-d H:i:s");
            $data["subtotal"] = $subTotal;
            $data["total"] = $subTotal + $totalIva;
            $factura = new Factura();
            $factura->fill($data);
            $factura->save();
            foreach ($data["items"] as  $item) {
                $item["total"]= $item["valor"]*$item["cantidad"];
                $factura->items()->create($item);
            }
            return response()->json(new FacturaResource($factura));
        } catch (\Throwable $th) {
           
        }
        
    }
    
    /**
     * getTotalIva
     *
     * @param  mixed $subtotal
     * @param  mixed $iva
     * @return float
     */
    public function getTotalIva(Float $subtotal,Int $iva):float {
        if($iva > 0){
            return  floor(($iva * $subtotal)/100);
        }
        return 0;
    }
    
    /**
     * byId
     *
     * @param  Factura $factura
     * @return void
     */
    public function byId(Factura $factura){
        try {

            return response()->json(new FacturaResource($factura));
        } catch (\Throwable $th) {
            
        }
    }

    public function all(Request $request){
        try {
          
            $validator = Validator::make($request->all(), [
                'Page' => 'nullable|numeric',
                "size"=>"nullable|numeric",
                "direction"=>"nullable|in:ASC,DESC",
            ]);
    
            if($validator->fails()){
                    return response()->json($validator->errors(), 400);
            }
    
            $page = $request->get("Page") > 0 ? $request->get("Page"):1;
            $size = $request->get("size") > 0 ? $request->get("size")  : 50 ;
            $request->merge(["page"=>$page]);
            $orderBy = $request->get("orderBy");
            $direction = $request->get("direction");
    
         
            $facturas = Factura::paginate($size);
            $paginate = $facturas->toArray();
            $response = [
                "Page" => $page,
                "PageSize" => $size,
                "TotalElements" => $paginate["total"],
                "TotalPages" => $paginate["last_page"],
                "results" => FacturaResource::collection($facturas),
            ];
            return response()->json($response);
        } catch (\Throwable $th) {
         
        }
    }
}
