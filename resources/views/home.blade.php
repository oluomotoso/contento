@extends('layouts/public')
@section('content')
    <header id="header">
        <div class="logo">
            <span class="icon fa-diamond" style="color: dodgerblue"></span>
        </div>
        <div class="row">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('message'))
                <div class="alert alert-success">
                    <strong>Success!</strong> {{ session('message') }}.
                </div>
            @endif


        </div>
        <div class="content">
            <div class="inner">
                <h1>CONTENTO</h1>
                <p>A content aggregating solution developed by <a href="https://www.femtosh.com">Femtosh Global
                        Solutions</a></p>
            </div>
        </div>
        <nav>
            <ul>
                <li><a href="#about">About</a></li>
                <li><a href="{{url('/login')}}">Login</a></li>
                <li><a href="{{url('/register')}}">Register</a></li>
                <li><a href="#contact">Contact</a></li>
                <!--<li><a href="#elements">Elements</a></li>-->
            </ul>
        </nav>
        <nav>
            <ul>
                <li><a href="{{url('/latest-contents')}}">Latest Contents</a></li>
            </ul>
        </nav>

    </header>

    <!-- Main -->
    <div id="main">
        <!-- About -->
        <article id="about">
            <h2 class="major">About</h2>
            <p>Contento is a subscription based content providing service that provides automatic contents for your site
                leveraging on a unique algorithm developed by Femtosh Global Solutions to find already published
                contents on the internet. Contento is free for 10 days for every domain.
            </p>
            <p>
            <h2>Contento for Blogger</h2>
            The contento is available for sites that are hosted by Blogger. To use Contento for Blogger,
            you have to register on this website and give us access to your Blogger account using the link provided.
            </p>
            <p>
            <h2>Contento for Wordpress</h2>
            The contento can be used on self hosted wordpress sites by installing this <a
                    href="https://drive.google.com/file/d/0Bxj4f9jISC0wcUQxS0NmVzJDaGc/view?usp=drive_web">Wordpress
                Plugin.</a>
            This plugin acts as a bridge between your WordPress site and your Contento account, connecting the two
            together.

            If you do not yet have a Contento account, [creating one is 100% free and only takes you about 30
            seconds](http://www.contento.com.ng/register)
            </p>
        </article>
        <!-- About -->
        <article id="download">
            <h2 class="major">Download</h2>

            <h2>Contento for Wordpress</h2>
            The contento can be used on self hosted wordpress sites by installing this <a
                    href="https://drive.google.com/file/d/0Bxj4f9jISC0wcUQxS0NmVzJDaGc/view?usp=drive_web">Wordpress
                Plugin.</a>
        </article>

        <!-- Contact -->
        <article id="contact">
            <h2 class="major">Contact</h2>
            <form method="post" action="{{url('/contact')}}">
                <div class="field half first">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name"/>
                </div>
                <div class="field half">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email"/>
                </div>
                <div class="field">
                    <label for="message">Message</label>
                    <textarea name="message" id="message" rows="4"></textarea>
                </div>
                <ul class="actions">
                    <li><input type="submit" value="Send Message" class="special"/></li>
                    <li><input type="reset" value="Reset"/></li>
                </ul>
            </form>
            <span class="text-bold">
                <p><i class="icon fa-location-arrow"> Address: </i>  No 38, MKO Abiola way, Ring Road, Ibadan, Nigeria</p>
   <p><i class="icon fa-mobile-phone"> phone: </i>  +23480-806-850-6757</p>
         <p><i class="icon fa-mail-reply"> email: </i>  info@femtosh.com</p>
            </span>
            <ul class="icons">
                <li><a href="https://twitter.com/weare_femtosh" class="icon fa-twitter"><span
                                class="label">Twitter</span></a></li>
                <li><a href="https://www.facebook.com/femtosh" class="icon fa-facebook"><span
                                class="label">Facebook</span></a></li>
            </ul>

        </article>
        <!-- Register -->

    </div>

    <!-- Footer -->
    <footer id="footer">
        <p class="copyright">&copy; Femtosh Global Solutions: <a href="https://www.femtosh.com">Femtosh</a>.</p>
    </footer>
@endsection