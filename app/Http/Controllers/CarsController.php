<?php

namespace App\Http\Controllers;

use App\Models\Cars;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Models\ValidationCar;

class CarsController extends Controller
{
    private $model;

    public function __construct(Cars $cars)
    {
        $this->model = $cars;
    }


    public function getAll() {
        try {
            $cars = $this->model->all();
            if(count($cars) > 0){
                return response()->json($cars, Response :: HTTP_OK);
            }else{
                return response()->json(["message" => "Nenhum veiculo cadastrado!"], Response :: HTTP_OK);
            }
        } catch (QueryException $e) {
            return response()->json(["Erro de conexão com o banco de dados" => $e], Response ::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function get($id) {
        try {
            $car = $this->model->find($id);
            return response()->json($car);
        } catch (QueryException $e) {
            return response()->json(["Erro de conexão com o banco de dados" => $e], Response ::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(Request $request) {
        $validator = Validator ::make(
            request()->all(),
            ValidationCar ::RULE_TO_CREATE
        );

        if($validator->fails()){
            return response()->json($validator->errors(), Response ::HTTP_BAD_REQUEST);
        }

        try {
            $car = $this->model->create($request->all());
            return response()->json($car);
        } catch (QueryException $e) {
            return response()->json(["Erro de conexão com o banco de dados!" => $e], Response ::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update($id, Request $request){
        $validator = Validator ::make(
            request()->all(),
            ValidationCar ::RULE_TO_UPDATE
        );

        if($validator->fails()){
            return response()->json($validator->errors(), Response ::HTTP_BAD_REQUEST);
        }

        try {
            $car = $this->model->find($id);
            if($car){
                $car->update($request->all());
                return response()->json($car);
            }else{
                return response()->json(["message" => "Nenhum veiculo encontrado!"], Response ::HTTP_BAD_REQUEST);
            }
            return response()->json($car);
        } catch (QueryException $e) {
            return response()->json(["Erro de conexão com o banco de dados" => $e], Response ::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id){
        try {
            $car = $this->model->find($id)
            ->delete();
            return response()->json(data:null);
        } catch (QueryException $e) {
            return response()->json(["Erro de conexão com o banco de dados" => $e], Response ::HTTP_INTERNAL_SERVER_ERROR);
        }

    }


}
