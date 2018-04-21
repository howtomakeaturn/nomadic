
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.2.3/css/bulma.min.css">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.2.3/css/bulma.min.css.map">

<body>

    <section class="hero is-primary">
      <div class="hero-body">
        <div class="container">
          <h1 class="title">
            Cafe Data Diff Tool
          </h1>
          <h2 class="subtitle">
            Check the difference of your cafe data.
          </h2>
        </div>
      </div>
    </section>

    <br>

    <form method="post" action='/compare-result'>
    <div class="columns is-gapless">
        <div class="column">
            <input type='text' name='path1' class='input' value='2016-11-20-13-09/taipei.csv' />
        </div>
        <div class="column">
            <input type='text' name='path2' class='input' value='2016-11-27-11-47/taipei.csv' />
        </div>
    </div>

    <center>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button type='submit' class='button is-primary is-large'>Compare</button>
    </center>
    </form>
</body>
