<?php

namespace Mrpath\BookingProduct\Http\Controllers\Admin;

use Carbon\Carbon;
use Mrpath\BookingProduct\Http\Controllers\Controller;
use Mrpath\BookingProduct\DataGrids\Admin\BookingDataGrid;
use Mrpath\BookingProduct\Repositories\BookingRepository;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $_config;

    /**
     * BookingRepository object
     *
     * @var \Mrpath\BookingProduct\Repositories\BookingRepository
     */
    protected $bookingRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BookingRepository $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;

        $this->_config = request('_config');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view($this->_config['view']);
    }

    /**
     * Returns a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get()
    {
        if (request('view_type')) {
            $startDate = request()->get('startDate')
                        ? Carbon::createFromTimeString(request()->get('startDate') . " 00:00:01")
                        : Carbon::now()->startOfWeek()->format('Y-m-d H:i:s');

            $endDate = request()->get('endDate')
                    ? Carbon::createFromTimeString(request()->get('endDate') . " 23:59:59")
                    : Carbon::now()->endOfWeek()->format('Y-m-d H:i:s');

            $bookings = $this->bookingRepository->getBookings([strtotime($startDate), strtotime($endDate)])
                ->map(function ($booking) {
                    $booking['start'] = Carbon::createFromTimestamp($booking->start)->format('Y-m-d H:i:s');
                    
                    $booking['end'] = Carbon::createFromTimestamp($booking->end)->format('Y-m-d H:i:s');

                    return $booking;
                });

            return response()->json([
                'bookings' => $bookings,
            ]);
        } else {
            return app(BookingDataGrid::class)->toJson();
        }
    }
}