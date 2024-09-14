<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ScamerScamOperation
 * 
 * @property int $id
 * @property int $scamer_id
 * @property string $description
 * @property Carbon $created_at
 * 
 * @property Scamer $scamer
 * @property Collection|ScamPhoto[] $scam_photos
 *
 * @package App\Models
 */
class ScamerScamOperation extends Model
{
	protected $table = 'scamer_scam_operations';
	public $timestamps = false;

	protected $casts = [
		'scamer_id' => 'int'
	];

	protected $fillable = [
		'scamer_id',
		'description'
	];

	public function scamer()
	{
		return $this->belongsTo(Scamer::class);
	}

	public function scam_photos()
	{
		return $this->hasMany(ScamPhoto::class, 'scam_operation_id');
	}
}
