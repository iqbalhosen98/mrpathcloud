<?php

namespace Mrpath\Marketing\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Mrpath\Core\Models\SubscribersList;
use Mrpath\Marketing\Mail\NewsletterMail;
use Mrpath\Marketing\Repositories\CampaignRepository;
use Mrpath\Marketing\Repositories\EventRepository;

class Campaign
{
    /**
     * EventRepository object
     *
     * @var \Mrpath\Marketing\Repositories\EventRepository
     */
    protected $eventRepository;

    /**
     * CampaignRepository object
     *
     * @var \Mrpath\Marketing\Repositories\CampaignRepository
     */
    protected $campaignRepository;

    /**
     * TemplateRepository object
     *
     * @var \Mrpath\Marketing\Repositories\TemplateRepository
     */
    protected $templateRepository;

    /**
     * Create a new helper instance.
     *
     * @param  \Mrpath\Marketing\Repositories\EventRepository  $eventRepository
     * @param  \Mrpath\Marketing\Repositories\CampaignRepository  $campaignRepository
     * @param  \Mrpath\Marketing\Repositories\TemplateRepository  $templateRepository
     *
     * @return void
     */
    public function __construct(
        EventRepository $eventRepository,
        CampaignRepository $campaignRepository,
        CampaignRepository $templateRepository
    ) {
        $this->eventRepository = $eventRepository;

        $this->campaignRepository = $campaignRepository;

        $this->templateRepository = $templateRepository;
    }

    /**
     * Process the email.
     *
     * @return void
     */
    public function process(): void
    {
        $campaigns = $this->campaignRepository->getModel()
            ->leftJoin('marketing_events', 'marketing_campaigns.marketing_event_id', 'marketing_events.id')
            ->leftJoin('marketing_templates', 'marketing_campaigns.marketing_template_id', 'marketing_templates.id')
            ->select('marketing_campaigns.*')
            ->where('marketing_campaigns.status', 1)
            ->where('marketing_templates.status', 'active')
            ->where(function ($query) {
                $query->where('marketing_events.date', Carbon::now()->format('Y-m-d'))
                    ->orWhereNull('marketing_events.date');
            })
            ->get();

        foreach ($campaigns as $campaign) {
            if ($campaign->event->name == 'Birthday') {
                $emails = $this->getBirthdayEmails($campaign);
            } else {
                $emails = $this->getEmailAddresses($campaign);
            }

            foreach ($emails as $email) {
                Mail::queue(new NewsletterMail($email, $campaign));
            }
        }
    }

    /**
     * Get the email address.
     *
     * @param  \Mrpath\Marketing\Contracts\Campaign  $campaign
     * @return array
     */
    public function getEmailAddresses($campaign)
    {
        if ($campaign->customer_group->code === 'guest') {
            $customerGroupEmails = SubscribersList::whereNull('customer_id');
        } else {
            $customerGroupEmails = $campaign->customer_group->customers()->where('subscribed_to_news_letter', 1);
        }

        return array_unique($customerGroupEmails->pluck('email')->toArray());
    }

    /**
     * Return customer's emails who has a birthday today.
     *
     * @param  \Mrpath\Marketing\Contracts\Campaign  $campaign
     * @return array
     */
    public function getBirthdayEmails($campaign)
    {
        return $campaign->customer_group
            ->customers()
            ->whereRaw('DATE_FORMAT(date_of_birth, "%m-%d") = ?', [Carbon::now()->format('m-d')])
            ->where('subscribed_to_news_letter', 1)
            ->pluck('email')
            ->toArray();
    }
}
