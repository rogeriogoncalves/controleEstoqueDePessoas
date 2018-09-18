<?php

namespace App\Models\Painel;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ["name", "number", "active", "category", "description"]; ///Campos liberados a serem preenchidos
    ///protected $guarded = ["admin"]; ///Campos que o usuário não pode preencher
}
