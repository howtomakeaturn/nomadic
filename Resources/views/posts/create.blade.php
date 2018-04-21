@extends('layout')
@section('head')

<style>
    .bg {
        padding-top: 20px;
        padding-bottom: 20px;
        text-align: center;
        line-height: 1.7;
    }
    .bg.-grey {
        background-color: #EEEEEE;
        color: #616161;
    }
    @media (min-width: 768px) {
        .bg {
            font-size: 18px;
        }
    }

    .post-block {
    }

    .post-block img {
        display: inline-block;
    }

    .post-block article {
        display: inline-block;
        width: 100%;
        vertical-align: top;
        word-wrap:break-word;
    }

    .post-block header {
        color: #9E9E9E;
    }

    .post-block section {
        padding-top: 15px;
    }

    .post-block img.-big {
        display: none;
    }
    .post-block img.-small {
        display: inline-block;
    }

    @media (min-width: 768px) {
        .post-block img.-big {
            display: inline-block;
        }
        .post-block img.-small {
            display: none;
        }
        .post-block article {
            display: inline-block;
            width: calc( 100% - 80px);
            vertical-align: top;
            padding-left: 15px;
        }
    }

</style>

@endsection
@section('content')



    <div class='container'>

        <br>

        <div class='row'>
            <div class='col-md-2'>

                <a href="/posts" style="margin-top: 15px;">&#171; 回到討論版首頁</a>
                <br>
                <br>

            </div>
            <div class='col-md-10'>
                <div class="post-block">
                    <img src='{{Auth::user()->profile->avatar}}' style="border-radius: 50%;" class='-big'>
                    <article>
                        <header>
                            <img src='{{Auth::user()->profile->avatar}}' style="border-radius: 50%; width: 40px;" class='-small'>
                            {{Auth::user()->name}} 發佈貼文
                        </header>
                        <section>
                            <form method="post" action="/new-post">
                                <input type='text' placeholder="標題..." class="form-control" name='title' required>
                                <br>
                                <textarea placeholder="貼文內容..." class="form-control" style='height: 400px;' name='content' required></textarea>
                                <br>
                                {{csrf_field()}}
                                <input type='submit' value='發佈貼文' class="btn btn-primary btn-lg" onclick="this.disabled=true; this.value='處理中，請稍候...'; this.form.submit();">
                                <br>
                                <br>
                            </form>
                        </section>
                    </article>
                </div>


            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){

            moment.locale('zh-tw');

            $('.timestamp').map(function(e){
                if ($.isNumeric($(this).text())) {
                    $(this).text(moment.unix($(this).text()).fromNow());
                }
            });

        });
    </script>

@endsection
