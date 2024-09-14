<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class ScamerName
 * 
 * @property int $id
 * @property int $scamer_id
 * @property string|null $firstname
 * @property string|null $secondname
 * @property string|null $lastname
 * 
 * @property Scamer $scamer
 *
 * @package App\Models
 */
class ScamerName extends Model
{
	protected $table = 'scamer_names';
	public $timestamps = false;

	protected $casts = [
		'scamer_id' => 'int'
	];

	protected $fillable = [
		'scamer_id',
		'firstname',
		'secondname',
		'lastname'
	];

	public function scamer()
	{
		return $this->belongsTo(Scamer::class);
	}
}
