<?php

namespace Mrpath\BookingProduct\Http\Controllers\Shop;

use Mrpath\BookingProduct\Http\Controllers\Controller;
use Mrpath\BookingProduct\Repositories\BookingProductRepository;
use Mrpath\BookingProduct\Helpers\DefaultSlot as DefaultSlotHelper;
use Mrpath\BookingProduct\Helpers\AppointmentSlot as AppointmentSlotHelper;
use Mrpath\BookingProduct\Helpers\RentalSlot as RentalSlotHelper;
use Mrpath\BookingProduct\Helpers\EventTicket as EventTicketHelper;
use Mrpath\BookingProduct\Helpers\TableSlot as TableSlotHelper;

class BookingProductController extends Controller
{
    /**
     * @return array
     */
    protected $bookingHelpers = [];

    /**
     * Create a new controller instance.
     *
     * @param  \Mrpath\BookingProduct\Repositories\BookingProductRepository  $bookingProductRepository
     * @param  \Mrpath\BookingProduct\Helpers\DefaultSlot                    $defaultSlotHelper
     * @param  \Mrpath\BookingProduct\Helpers\AppointmentSlot                $appointmentSlotHelper
     * @param  \Mrpath\BookingProduct\Helpers\RentalSlot                     $rentalSlotHelper
     * @param  \Mrpath\BookingProduct\Helpers\EventTicket                    $EventTicketHelper
     * @param  \Mrpath\BookingProduct\Helpers\TableSlot                      $tableSlotHelper
     * @return void
     */
    public function __construct(
        BookingProductRepository $bookingProductRepository,
        DefaultSlotHelper $defaultSlotHelper,
        AppointmentSlotHelper $appointmentSlotHelper,
        RentalSlotHelper $rentalSlotHelper,
        EventTicketHelper $eventTicketHelper,
        TableSlotHelper $tableSlotHelper
    )
    {
        $this->bookingProductRepository = $bookingProductRepository;
        
        $this->bookingHelpers['default'] = $defaultSlotHelper;

        $this->bookingHelpers['appointment'] = $appointmentSlotHelper;

        $this->bookingHelpers['rental'] = $rentalSlotHelper;

        $this->bookingHelpers['event'] = $eventTicketHelper;

        $this->bookingHelpers['table'] = $tableSlotHelper;
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookingProduct = $this->bookingProductRepository->find(request('id'));

        return response()->json([
            'data' => $this->bookingHelpers[$bookingProduct->type]->getSlotsByDate($bookingProduct, request()->get('date')),
        ]);
    }
}