<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Compromisso
 *
 * @property $id
 * @property $consultor_id
 * @property $data
 * @property $hora_inicio
 * @property $hora_fim
 * @property $intervalo
 * @property $created_at
 * @property $updated_at
 *
 * @property Consultore $consultore
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Compromisso extends Model
{
    
    protected $perPage = 20;
    protected $fillable = ['consultor_id', 'data', 'hora_inicio', 'hora_fim', 'intervalo'];

     // Formatação de data e horas
     protected $dates = ['data', 'hora_inicio', 'hora_fim', 'intervalo'];

     // Calcular o total de horas
     public function getTotalHoras()
     {
         $inicio = \Carbon\Carbon::parse($this->hora_inicio);
         $fim = \Carbon\Carbon::parse($this->hora_fim);
         $intervalo = \Carbon\Carbon::parse($this->intervalo);
     
         $totalMinutos = $fim->diffInMinutes($inicio) - $intervalo->diffInMinutes($inicio);
         return max($totalMinutos / 60, 0);
     }
     
     public function getValorTotal()
     {
         return $this->getTotalHoras() * ($this->consultore->valor_hora ?? 0);
     }
    public function consultore()
    {
        return $this->belongsTo(Consultore::class, 'consultor_id');
    }
    
}
