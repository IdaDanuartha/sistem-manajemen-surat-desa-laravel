<?php
namespace App\Utils;

class UpdateSkLetter
{
	public static function update($request) {
        $request["sk"]["is_published"] = true;
        $request["sk"]["environmental_head_id"] = null;
        $request["sk"]["section_head_id"] = null;
        $request["sk"]["village_head_id"] = null;
        $request["sk"]["status_by_environmental_head"] = 0;
        $request["sk"]["status_by_section_head"] = 0;
        $request["sk"]["status_by_village_head"] = 0;
        $request["sk"]["reject_reason"] = null;
    }
}