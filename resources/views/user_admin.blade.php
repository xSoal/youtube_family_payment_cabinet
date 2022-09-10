@extends('layouts.user_admin')

<?php
//                var_dump($user_data);
// var_dump($user->email);
?>

@section('content')
    <div class="">
        <div class="logout">
            <a href="/logout">Выйти</a>
        </div>
        <div class="header">
            <div class="user__data">
                <div class="user__name">Логин: {{ $user->name  }}</div>
                <div class="user__email">Почта: {{ $user->email  }}</div>
            </div>

        </div>
        <div class="body">
            <table class="table">
                <tr class="tr">
                    <td>
                        Состояние счета:
                    </td>
                    <td>
                        {{ $user->balance  }}
                    </td>
                </tr>
            </table>

            <?php
//            echo "<pre>";
//            var_dump($payments_status_of_end_month);
            ?>

            <table class="table table--periods">
                @foreach($user_data as $month => $periods)
                    <tr>
                        <td>
                            {{$month}}
                        </td>
                        <td>
                            <?php  $last_month = ""; ?>
                            @foreach($periods as $period)
                                @if($period->type === 'period')
                                    <?php $last_month = $period->date; ?>
                                    <div class="td__cont td__cont--period">
                                        <div>
                                            Тип: период
                                        </div>
                                        <div>
                                            Сумма: {{$period->price}}
                                        </div>
                                        <div>
                                            Тянул за {{$period->users_count}}чел.
                                        </div>

                                    </div>

                                @else
                                    <div class="td__cont td__cont--payment">
                                        <div>
                                            Тип: оплата
                                        </div>
                                        <div>
                                            Сумма: {{$period->amount}}
                                        </div>
                                        <div>
                                            Дата: {{$period->date}}
                                        </div>

                                    </div>
                                @endif

                            @endforeach
                                @if(isset($payments_status_of_end_month[$last_month]))
                                    <div class="td__cont td__cont--end_of_month">
                                        <div>
                                            Сумма на конец месяца: <?php
                                            echo $payments_status_of_end_month[$last_month];;
                                            ?>
                                        </div>
                                    </div>
                                @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
