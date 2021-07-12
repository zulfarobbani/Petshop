<?php

namespace App\Calendar\Controller;

use App\Calendar\Model\LeapYear;
use Core\GlobalFunc;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LeapYearController extends GlobalFunc
{
    public function index(Request $request, $year)
    {
        $leapYear = new LeapYear();
		if ($leapYear->isLeapYear($year)) {
			$response = new Response('Yep, this is a leap year!');
		} else {
			$response = new Response('Nope, this is not a leap year.'.rand());
		}

		// ** untuk penggunaan response cache **
		//$response->setTtl(10);

		return $response;
    }

	public function testing(Request $request)
	{
		$id = $request->attributes->get('id');
		$nama_pegawai = "Deden";
		$leapYear = new LeapYear;
		$data = $leapYear->isLeapYear("2021");

        return $this->render_template('subs/hello', ['nama_pegawai' => $nama_pegawai, 'data_bebas' => $data, 'id' => $id]);
	}
}