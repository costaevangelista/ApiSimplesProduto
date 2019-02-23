<?php

namespace App\Service;

use App\Models\Product;
use App\Validators\ProductValidator;
use Illuminate\Http\Request;

class ProductService
{
    /**
     * @var ProductValidator
     */
    private $validator;
    /**
     * @var Request
     */
    private $request;

    /**
     * ProductService constructor.
     * @param ProductValidator $validator
     * @param Request $request
     */
    public function __construct(ProductValidator $validator, Request $request)
    {
        $this->validator = $validator;
        $this->request = $request;
    }

    public function index()
    {
        return Product::orderBy('name')->paginate(10);
    }

    public function show($id)
    {
        if (!is_numeric($id)) {
            return \Response()->json(['error' => 'O Código informado não é um número'], 400);
        }

        $obj = Product::find($id);
        if (@count($obj) === 0) {
            return \Response()->json(['error' => 'Objeto não existe!'], 400);
        }
        return \Response()->json($obj, 200);
    }

    public function create(array $data)
    {
        try {
            $valida = $this->validator->create($data);
            if ($valida->fails()) {
                return response()->json($valida->errors(), 400);
            }
            $obj = Product::create($data);

            return \Response()->json($obj, 201);
        } catch (ValidatorException $e) {
            return \Response()->json($e->getMessageBag(), 400);
        }
    }

    public function update(array $data, $id)
    {
        try {
            if (!is_numeric($id)) {
                return \Response()->json(['error' => 'O Código informado não é um número'], 400);
            }

            $obj = Product::find($id);
            if (@count($obj) === 0) {
                return \Response()->json(['error' => 'Objeto não existe!'], 400);
            }

            $valida = $this->validator->update($data, $id);
            if ($valida->fails()) {
                return \Response()->json($valida->getMessageBag(), 400);
            }
            $obj = Product::where('id', $id)->update($data);
            $obj = Product::find($id);

            return \Response()->json($obj, 201);
        } catch (ValidatorException $e) {
            return \Response()->json($e->getMessageBag(), 400);
        }
    }

    public function delete($id)
    {
        try {
            if (!is_numeric($id)) {
                return \Response()->json(['error' => 'O Código informado não é um número'], 400);
            }
            if (Product::destroy($id)) {
                return \Response()->json(['success' => 'Objeto removido com sucesso!'], 200);
            }

            return \Response()->json(['error' => 'Objeto não existe!'], 400);

        } catch (\PDOException $e) {
            if ($e->getCode() === "23000") {
                $codigo = $e->getCode();
                return \Response()->json(['error' => 'A Product não pode ser removida devido suas informações estarem vinculadas a outras tabelas em nosso DB! Nº do Erro: ' . $codigo], 409);
            }
            return \Response()->json(['error' => 'Erro ao Realizar a Solicitação!'], 500);
        }
    }

    public function searchName($name)
    {
        return Product::where('name', 'like', '%' . $name . '%')->paginate(10);
    }

}
