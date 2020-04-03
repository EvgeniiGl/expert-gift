<?php

namespace App\Jobs;

use App\Models\Gift;
use App\Services\Categories\ParseEtcyComService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SaveInfoGiftJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $retryAfter = 5;
    public $tries = 3;

    private $gift;
    private $parseEtsyService;

    /**
     * Create a new job instance.
     *
     * @param Gift $gift
     */
    public function __construct(Gift $gift)
    {
        $this->gift = $gift;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $parseEtsyService = new ParseEtcyComService();
        $info             = $parseEtsyService->getInfoGift($this->gift->url);
        $this->gift->where('id', $this->gift->id)->update($info);
        logs()->info("Подарок {$this->gift->id} записан");
    }
}
