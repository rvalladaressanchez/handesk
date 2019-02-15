<?php

namespace App;
use DB;
class Registro extends BaseModel
{
    public static function registrar($usuario, $accion, $comentario){
        DB::table('registros')->insert([
            'usuario' => $usuario,
            'accion' => $accion,
            'comentario' =>$comentario,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s")
        ]);
        return true;
    }
}
