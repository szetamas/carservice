<h1>carservice</h1>
<p>This is a carservice laravel app.</p>
<h2>Install:</h2>
<ol>
  <li>You have to make the .env and configure database (eg.: ip, username, password, ports):<br>
  <code>cp .env.example .env</code><br>
  OR right click, copy paste, rename</li>
  <li>Import /database/datas/carservice.sql to the database</li>
  <li>Install components with:
  <br><code>composer install --no-scripts</code></li>
  <li>Generate keys:<br>
  <code>php artisan key:generate</code></li>
  <li>If you need you could start the laravel app with:<br>
  <code>php artisan serve</code><br>
  (may loading datas from jsons could take some time)</li>
</ol>
<h3>Used versions of softwares:</h3>
<ul>
  <li>PHP: 8.2.4</li>
  <li>Laravel: 10.33.0</li>
  <li>Composer: 2.6.5</li>
</ul>
<h2>Todos:</h2>
<ul>
  <li>replace cardnumber to something else (GDRP, law issues)</li>
  <li>Json datas dont fit here:<br>clients: card_number<br>services: log_number, event_time<br>cars: accidents</li>
  <li>some user has no car, so may they dont needed to exist in database</li>
</ul>
