<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Consultore
 *
 * @property $id
 * @property $nome_completo
 * @property $valor_hora
 * @property $created_at
 * @property $updated_at
 *
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Consultore extends Model
{
    
    protected $perPage = 20;
    protected $fillable = ['nome_completo', 'valor_hora'];

    public function compromissos()
    {
        return $this->hasMany(Compromisso::class, 'consultor_id');
    }

}
