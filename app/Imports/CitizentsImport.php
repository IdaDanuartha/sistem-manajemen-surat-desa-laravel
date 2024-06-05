<?php

namespace App\Imports;

use App\Enums\BloodGroup;
use App\Enums\Gender;
use App\Enums\MaritalStatus;
use App\Enums\Religion;
use App\Enums\Role;
use App\Enums\UserStatus;
use App\Models\Citizent;
use App\Models\User;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CitizentsImport implements ToModel, WithHeadingRow
{
    use Importable;
    
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $citizent = Citizent::create([
            'name' => $row["nama"],			
			'environmental_id' => $this->getEnvironmentalCode($row["kode_lingkungan"]),			
			'national_identify_number' => $row["nik"],			
			'family_card_number' => $row["no_kk"],			
			'phone_number' => $row["nomor_telepon"],			
			'gender' => $this->getGender($row["jenis_kelamin"]),			
			'birth_place' => $row["tempat_lahir"],			
			'birth_date' => $row["tanggal_lahir"],			
			'blood_group' => $this->getBloodGroup($row["golongan_darah"]),			
			'religion' => $this->getReligion($row["agama"]),			
			'marital_status' => $this->getMaritalStatus($row["status_nikah"]),			
			'citizenship' => $row["kewarganegaraan"],			
			'work' => $row["pekerjaan"],			
			'address' => $row["alamat"],
        ]);

        return $citizent->user()->create([
            'username' => $row["nik"],
            'email' => $row["email"],
            'password' => $row["password"],
            'status' => UserStatus::ACTIVE,
            'role' => Role::CITIZENT,
            "authenticatable_id" => $citizent->id,
            "authenticatable_type" => "App\Models\Citizent"
        ]);
    }

    public function getEnvironmentalCode(string $code) {
		return match ($code) {
			'LJK' => 1,
			'JSK' => 2,
			'GLR' => 3,
            'GT' => 4,
            'LT' => 5,
            'LD' => 6,
            'LG' => 7,
            'TLGMS' => 8,
            'KRS' => 9,
            'GLK' => 10,
		};
    }

    public function getGender(string $gender) {
		return match ($gender) {
			'Laki-Laki' => Gender::MAN,
			'Perempuan' => Gender::WOMAN,
		};
    }

    public function getBloodGroup(string $bloodGroup) {
		return match ($bloodGroup) {
			'O' => BloodGroup::O,
			'A' => BloodGroup::A,
			'B' => BloodGroup::A,
			'AB' => BloodGroup::AB,
		};
    }

    public function getReligion(string $religion) {
		return match ($religion) {
			'Islam' => Religion::ISLAM,
			'Protestan' => Religion::PROTESTAN,
			'Katolik' => Religion::KATOLIK,
			'Hindu' => Religion::HINDU,
			'Budha' => Religion::BUDHA,
			'Konghucu' => Religion::KONGHUCU,
		};
    }

    public function getMaritalStatus(string $maritalStatus) {
		return match ($maritalStatus) {
			'Belum Kawin' => MaritalStatus::SINGLE,
			'Kawin' => MaritalStatus::MARRY,
			'Cerai Hidup' => MaritalStatus::DIVORCE,
			'Cerai Mati' => MaritalStatus::DEATH_DIVORCE,
		};
    }
}
