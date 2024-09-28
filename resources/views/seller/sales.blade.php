@extends('seller.layout')

@section('content')
<div class="content m-4 bg-white shadow-lg p-4 rounded-[4px] h-[100vh] overflow-y-auto">
    <div class="">
        <div class="grid grid-cols-1 lg:grid-cols-2 text-white seller-info">
            <div class="dashcards p-4 px-4">
                <div class="col bg-gradient-to-r from-[#02AABD] to-[#00CDAC] h-40 flex justify-around items-center rounded-[4px]">
                    <div class="icon text-6xl">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                    <div class="title font-bold text-2xl">
                        Total Orders
                        <div class="w-full text-center">{{$seller_info['total_orders']}}</div>
                    </div>
                </div>
            </div>
            <div class="dashcards p-4 px-4">
                <div class="col bg-gradient-to-r from-[#2E3192] to-[#1BFFFF] h-40 flex justify-around items-center rounded-[4px]">
                    <div class="icon text-6xl">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div class="title font-bold text-2xl">
                        Total Reach
                        <div class="w-full text-center">{{$seller_info['total_reach']}}</div>
                    </div>
                </div>
            </div>
            <div class="dashcards p-4 px-4">
                <div class="col bg-gradient-to-r from-orange-400 via-red-500 to-pink-500 h-40 flex justify-around items-center rounded-[4px]">
                    <div class="icon text-6xl">
                        <i class="fa-solid fa-dollar"></i>
                    </div>
                    <div class="title font-bold text-2xl">
                        Earnings
                        <div class="w-full text-center">{{$seller_info['total_earnings']}}</div>
                    </div>
                </div>
            </div>
            <div class="dashcards p-4 px-4">
                <div class="col bg-gradient-to-r from-[#C33764] to-[#1D2671] h-40 flex justify-around items-center rounded-[4px]">
                    <div class="icon text-6xl">
                        <i class="fa-solid fa-boxes-stacked"></i>
                    </div>
                    <div class="title font-bold text-2xl">
                        Product Sold
                        <div class="w-full text-center">{{$seller_info['total_product_sold']}}</div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <div class="yearly-sale my-4">
        <div class="heading w-full border-b-4 border-[#000328] text-2xl text-[#000328] font-bold">Yearly Sales</div>
        <div class="year-buttons text-[12px] py-2 w-full flex overflow-x-auto">
            @for ($i = 0; $i < 6; $i++)
                <button data-year="{{\Carbon\Carbon::now()->subYears($i)->format('Y')}}" class="shrink-0 label bg-green-200 mx-1 px-4 py-2 rounded-sm {{ $i === 0 ? 'active' : '' }}">
                {{ \Carbon\Carbon::now()->subYears($i)->format('Y') }}
                </button>
                @endfor
        </div>
        <div class="simple-bar-chart" id="yearly-chart">

            @foreach($seller_info['yearly_orders'] as $orders)
            <div class="item" style="--clr: #5EB344; --val: {{ $orders['count'] * 10 }};">
                <div class="label">{{\Illuminate\Support\Str::limit(\Carbon\Carbon::parse($orders['month'])->format('F'),3,'')}}</div>
                <div class="value">{{$orders['count']}}</div>
                
            </div>
            @endforeach

        </div>
    </div>

    <div class="monthly-sale mt-4">
        <div class="heading w-full border-b-4 border-[#000328] text-2xl text-[#000328] font-bold flex justify-between">
            Monthly Sales
        </div>
        <div class="month-buttons text-[12px] py-2 w-full flex overflow-x-auto">
            @foreach($seller_info['yearly_orders'] as $orders)
            <button data-month="{{date('y-m-d',strtotime($orders['month']))}}" class="shrink-0 label bg-green-200 mx-1 px-4 py-2  rounded-sm @if(\Carbon\Carbon::parse($orders['month'])->format('F') === \Carbon\Carbon::now()->format('F') ) active @endif">
                {{\Illuminate\Support\Str::limit(\Carbon\Carbon::parse($orders['month'])->format('F'),3,'')}}
                {{\Carbon\Carbon::parse($orders['month'])->format('y')}}
            </button>
            @endforeach
        </div>
        <div class="simple-bar-chart" id="monthly-chart">
            @foreach($seller_info['monthly_orders'] as $orders)
            <div class="item " style="--clr: #5EB344; --val: {{ $orders['count'] * 10 }};">
                <div class="label">{{ \Carbon\Carbon::parse($orders['date'])->format('d') }}</div> <!-- Only the day -->
                <div class="value">@if($orders['count']>0){{ $orders['count'] }}@endif</div>
            </div>
            @endforeach
        </div>

    </div>

</div>



<script>
    $(document).ready(function() {
        $('.month-buttons').on('click', 'button', function() {

            $('.month-buttons button').removeClass('active');
            $(this).addClass('active');
            var month = $(this).data('month');

            setMonthlyChart(month);
        });

        $('.year-buttons button').on('click', function() {
            $('.year-buttons button').removeClass('active');

            $(this).addClass('active');
            var year = $(this).data('year')

            setYearlyChart(year);

        })



        function setMonthlyChart(month) {

            $.ajax({
                url: `{{ route('getMonthlySale') }}/${month}`,
                method: 'get',
                success: function(data) {
                    var chart = data.map((item) => {
                        let date = new Date(item.date);
                        let day = date.getDate();

                        return `
                <div class="item" style="--clr: #5EB344; --val: ${item.count * 10};">
                    <div class="label">${day}</div> <!-- Only the day -->
                    <div class="value">${item.count > 0 ? item.count : ''}</div> <!-- Show count only if > 0 -->
                </div>
            `;
                    });

                    $('#monthly-chart').html('');

                    $('#monthly-chart').append(chart.join(''));
                }
            });

        }

        function setYearlyChart(year) {
            let monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

            $.ajax({
                url: `{{ route('getYearlySale') }}/${year}`,
                method: 'get',
                success: function(data) {

                    var yearlyChart = data.map((item) => {
                        var date = new Date(item.month);
                        var month = date.getMonth();

                        return `
                <div class="item" style="--clr: #5EB344; --val: ${item.count * 10};">
                    <div class="label">${monthNames[month]}</div> <!-- Only the day -->
                    <div class="value">${item.count > 0 ? item.count : ''}</div> <!-- Show count only if > 0 -->
                </div>
            `;
                    });

                    var monthButtons = data.map((item) => {
                        var date = new Date(item.month);
                        var month = date.getMonth();

                        var year = date.getFullYear() + "";
                        var shortYear = year.substring(2, 4)

                        return month === 0 ? `<button data-month="${getFormatedDate(date)}" class="shrink-0 label bg-green-200 mx-1 px-4 py-2  rounded-sm active">${ monthNames[month] } ${shortYear}</button>` :
                            `<button data-month="${getFormatedDate(date)}" class="shrink-0 label bg-green-200 mx-1 px-4 py-2  rounded-sm ">${ monthNames[month] } ${shortYear}</button>`;
                    });

                    $('#yearly-chart').html('');
                    $('.month-buttons').html('')
                    $('#yearly-chart').append(yearlyChart.join(''));
                    $('.month-buttons').append(monthButtons.join(''));

                    var date = new Date(data[0].month);


                    setMonthlyChart(getFormatedDate(date));
                }
            });


        }

        function getFormatedDate(date) {
            var year = date.getFullYear() + "";
            var shortYear = year.substring(2, 4);
            var month = (date.getMonth() + 1).toString().padStart(2, '0');
            var formattedDate = shortYear + "-" + month + "-" + '01';
            return formattedDate;
        }




    })
</script>

@endsection