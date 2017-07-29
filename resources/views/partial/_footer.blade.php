<footer class="footer">
    <div class="container">
        <div class='row'>
            <div class='col-md-12'>
                <a href='/' style='font-size: 24px; margin-bottom: 20px;'>{{ config('nomadic.global.app') }}</a>
            </div>
        </div>
    </div>
</footer>

<style>
body > .footer {
    padding-top: 50px;
    background-color: #212121;
    color: #EEEEEE;
    padding-bottom: 50px;
    text-align: center;
}
body > footer a {
    color: white;
    display: block;
    padding-top: 6px;
    padding-bottom: 6px;
}
body > footer a:hover {
    color: white;
    text-decoration: underline;
}
@media (min-width: 768px) {
    body > .footer {
        padding-top: 60px;
        padding-bottom: 60px;
        text-align: left;
    }
}
</style>
