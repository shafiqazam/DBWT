@extends('werbeseiteLayout')
@section('styling')
    <link rel="stylesheet" href="{{ asset('css/hauptseite.css') }}">
@endsection

@section('title', 'Hauptseite')

@section('header')
    <div class="header">
        <div id="logo">
            <img src="./img/logoMensa.png" alt="E-Mensa Logo">
        </div>
        <div id="navigation">
            <ul>
                <li><a href="#Ankündigungen">Ankündigung</a></li>
                <li><a href="#Speisekarte">Speisen</a></li>
                <li><a href="#Statistik">Zahlen</a></li>
                <li><a href="#form">Kontakt</a></li>
                <li><a href="#Wichtig">Wichtig für uns</a></li>
            </ul>
        </div>
    </div>
@endsection

@section('main')
    <div class="body">
        <div id="left"></div>
        <div id="center">
            <div id="banner">
                <img src="./img/Banner.jpg" alt="banner">
            </div>
            <div id="Ankündigungen">
                <h2>Bald gibt es Essen auch online ;)</h2>
                <p>
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut
                    labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores
                    et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut
                    labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores
                    et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
                </p>
            </div>
            <div id="Speisekarte">
                <h2>Köstlichkeiten, die Sie erwarten</h2>
                <table>
                    <thead>
                    <tr>
                        <th></th>
                        <th>Preis intern</th>
                        <th>Preis extern</th>
                        <th>Allergens</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($gerichts as $gericht)
                        <tr>
                        <td>{{$gericht->name}}</td>
                        <td>{{$gericht->preis_intern}}</td>
                         <td>{{$gericht->preis_extern}}</td>
                            @if($gericht->allergens != [])
                                <td>{{$gericht->allergens}}</td>
                            @else
                                <td>-</td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>...</th>
                        <th>...</th>
                        <th>...</th>
                        <th>...</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <h3>Allergenshinweise: </h3>
            <div id="Allergens">
                @foreach($allergens_code as $code => $name)
                    <div class="allergens-list">{{$code}} => {{$name}}</div>
                @endforeach
            </div>
            <div id="Statistik">
                <h2>E-Mensa in Zahlen</h2>
                <ul>
                    <li>{{(int)$zaehler['Besuche']}}</li>
                    <li>Besuche</li>
                    <li>{{(int)$zaehler['Anmeldungen zum Newsletter']}}</li>
                    <li>Anmeldungen zum Newsletter</li>
                    <li>{{(int)$zaehler['Speisen']}}</li>
                    <li>Speisen</li>
                </ul>
            </div>
            <div id="form">
                <h2>Interesse geweckt? Wir informieren Sie!</h2>
                <form id="newsletteranmeldung" method="post"><!--action="index.php"-->
                    <label for="name">Ihr Name:<br>
                        <input type="text" id="name" name="user" placeholder="Vorname" required>
                    </label>
                    <label for="email">Ihre E-Mail:<br>
                        <input type="text" id="email" name="email" placeholder="" required>
                    </label>
                    <label for="language">Newsletter bitte in:<br>
                        <select id="language" name="language">
                            <option value="de" selected>Deutsch</option>
                            <option value="en">English</option>
                        </select>
                    </label><br>
                    <label for="datenschutz">
                        <input type="checkbox" id="datenschutz" name="datenschutz" required>
                        Den Datenschutzbestimmungen stimme ich zu
                    </label>
                    <input type="submit" id="submit" value="Zum Newsletter anmelden"><!--disabled-->
                </form>
            </div>
            <div id="Wichtig">
                <h2>Das ist uns wichtig</h2>
                <ul>
                    <li>Beste frische saisonale Zutaten</li>
                    <li>Ausgewogene abwechslungsreiche Gerichte</li>
                    <li>Sauberkeit</li>
                </ul>
            </div>
            <div>
                <h1>Wir freuen uns auf Ihren Besuch!</h1>
            </div>
        </div>
        <div id="right"></div>
    </div>
@endsection

@section('footer')
    <div class="footer">
        <ul>
            <li>&copy; E-Mensa GmbH</li>
            <li>Marco Catulo</li>
            <li>Shafiq Azam</li>
            <li><a href="impressum.html">Impressum</a></li>
        </ul>
    </div>
@endsection
