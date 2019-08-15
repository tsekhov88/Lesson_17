<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Car;

class CreateNewReport implements ShouldQueue // обработан как задача в очереди
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $limit;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($limit)
    {
        $this->limit = $limit; 
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        @unlink(public_path('report.pdf'));
        $html = $this->getHtml();
        $mpdf = new \Mpdf\Mpdf();
        $mpdf->WriteHtml($html);
        $mpdf->Output(public_path('report.pdf'), 'F');
    }

    public function getHtml()
    {
        $html = '<table>';
        $cars = Car::query()->limit($this->limit)->get();
        foreach ($cars as $car) {
            $tr = '<tr>';
            $tr .= ('<td>'. $car->owner_name . '</td>');
            $tr .= ('<td>'. $car->car_brand . '</td>');
            $tr .= ('<td>'. $car->car_model . '</td>');
            $tr .= ('<td>'. $car->year . '</td>');
            $tr .= ('<td>'. $car->distance . '</td>');
            $tr .='</tr>';
            $html .= $tr;
        }
        $html .='</table>';


        return $html;
    }
}
