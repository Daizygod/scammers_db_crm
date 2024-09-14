<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Scamer
 * 
 * @property int $id
 * @property string|null $firstname
 * @property string|null $secondname
 * @property string|null $lastname
 * @property string|null $description
 * @property bool $visible
 * 
 * @property Collection|ScamerName[] $scamer_names
 * @property Collection|ScamerPass[] $scamer_passes
 * @property Collection|ScamerPhone[] $scamer_phones
 * @property Collection|ScamerProfile[] $scamer_profiles
 * @property Collection|ScamerPhoto[] $scamer_photos
 * @property Collection|ScamerScamOperation[] $scamer_scam_operations
 *
 * @package App\Models
 */
class Scamer extends Model
{
	protected $table = 'scamers';
	public $timestamps = false;

	protected $casts = [
		'visible' => 'bool'
	];

	protected $fillable = [
		'firstname',
		'secondname',
		'lastname',
		'description',
		'visible'
	];

	public function scamer_names()
	{
		return $this->hasMany(ScamerName::class);
	}

	public function scamer_passes()
	{
		return $this->hasMany(ScamerPass::class);
	}

	public function scamer_phones()
	{
		return $this->hasMany(ScamerPhone::class);
	}

	public function scamer_profiles()
	{
		return $this->hasMany(ScamerProfile::class);
	}

	public function scamer_photos()
	{
		return $this->hasMany(ScamerPhoto::class);
	}

	public function scamer_scam_operations()
	{
		return $this->hasMany(ScamerScamOperation::class);
	}
}
