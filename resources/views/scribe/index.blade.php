<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Laravel API Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.style.css") }}" media="screen">
    <link rel="stylesheet" href="{{ asset("/vendor/scribe/css/theme-default.print.css") }}" media="print">

    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>

    <link rel="stylesheet"
          href="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/styles/obsidian.min.css">
    <script src="https://unpkg.com/@highlightjs/cdn-assets@11.6.0/highlight.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jets/0.14.1/jets.min.js"></script>

    <style id="language-style">
        /* starts out as display none and is replaced with js later  */
                    body .content .bash-example code { display: none; }
                    body .content .javascript-example code { display: none; }
            </style>

    <script>
        var tryItOutBaseUrl = "http://localhost";
        var useCsrf = Boolean();
        var csrfUrl = "/sanctum/csrf-cookie";
    </script>
    <script src="{{ asset("/vendor/scribe/js/tryitout-5.11.0.js") }}"></script>

    <script src="{{ asset("/vendor/scribe/js/theme-default-5.11.0.js") }}"></script>

</head>

<body data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">

<a href="#" id="nav-button">
    <span>
        MENU
        <img src="{{ asset("/vendor/scribe/images/navbar.png") }}" alt="navbar-image"/>
    </span>
</a>
<div class="tocify-wrapper">
    
            <div class="lang-selector">
                                            <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                            <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                    </div>
    
    <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>

    <div id="toc">
                    <ul id="tocify-header-introduction" class="tocify-header">
                <li class="tocify-item level-1" data-unique="introduction">
                    <a href="#introduction">Introduction</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authenticating-requests" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authenticating-requests">
                    <a href="#authenticating-requests">Authenticating requests</a>
                </li>
                            </ul>
                    <ul id="tocify-header-authentication" class="tocify-header">
                <li class="tocify-item level-1" data-unique="authentication">
                    <a href="#authentication">Authentication</a>
                </li>
                                    <ul id="tocify-subheader-authentication" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="authentication-POSTapi-login">
                                <a href="#authentication-POSTapi-login">Login</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentication-POSTapi-register">
                                <a href="#authentication-POSTapi-register">Ajukan Akun Baru</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentication-GETapi-user">
                                <a href="#authentication-GETapi-user">Data user saat ini</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="authentication-POSTapi-logout">
                                <a href="#authentication-POSTapi-logout">Logout</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-unit-layanan-perda" class="tocify-header">
                <li class="tocify-item level-1" data-unique="unit-layanan-perda">
                    <a href="#unit-layanan-perda">Unit Layanan - Perda</a>
                </li>
                                    <ul id="tocify-subheader-unit-layanan-perda" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="unit-layanan-perda-GETapi-unit-layanan-perda">
                                <a href="#unit-layanan-perda-GETapi-unit-layanan-perda">Daftar Perda</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="unit-layanan-perda-POSTapi-unit-layanan-perda">
                                <a href="#unit-layanan-perda-POSTapi-unit-layanan-perda">Tambah Perda</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="unit-layanan-perda-PUTapi-unit-layanan-perda--id-">
                                <a href="#unit-layanan-perda-PUTapi-unit-layanan-perda--id-">Perbarui Perda</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="unit-layanan-perda-DELETEapi-unit-layanan-perda--id-">
                                <a href="#unit-layanan-perda-DELETEapi-unit-layanan-perda--id-">Hapus Perda</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-unit-layanan-perwali" class="tocify-header">
                <li class="tocify-item level-1" data-unique="unit-layanan-perwali">
                    <a href="#unit-layanan-perwali">Unit Layanan - Perwali</a>
                </li>
                                    <ul id="tocify-subheader-unit-layanan-perwali" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="unit-layanan-perwali-GETapi-unit-layanan-perwali">
                                <a href="#unit-layanan-perwali-GETapi-unit-layanan-perwali">Daftar Perwali</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="unit-layanan-perwali-POSTapi-unit-layanan-perwali">
                                <a href="#unit-layanan-perwali-POSTapi-unit-layanan-perwali">Tambah Perwali</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="unit-layanan-perwali-PUTapi-unit-layanan-perwali--id-">
                                <a href="#unit-layanan-perwali-PUTapi-unit-layanan-perwali--id-">Perbarui Perwali</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="unit-layanan-perwali-DELETEapi-unit-layanan-perwali--id-">
                                <a href="#unit-layanan-perwali-DELETEapi-unit-layanan-perwali--id-">Hapus Perwali</a>
                            </li>
                                                                        </ul>
                            </ul>
                    <ul id="tocify-header-unit-layanan-profil" class="tocify-header">
                <li class="tocify-item level-1" data-unique="unit-layanan-profil">
                    <a href="#unit-layanan-profil">Unit Layanan - Profil</a>
                </li>
                                    <ul id="tocify-subheader-unit-layanan-profil" class="tocify-subheader">
                                                    <li class="tocify-item level-2" data-unique="unit-layanan-profil-GETapi-unit-layanan-profile">
                                <a href="#unit-layanan-profil-GETapi-unit-layanan-profile">Ambil data profil</a>
                            </li>
                                                                                <li class="tocify-item level-2" data-unique="unit-layanan-profil-PUTapi-unit-layanan-profile">
                                <a href="#unit-layanan-profil-PUTapi-unit-layanan-profile">Simpan / perbarui profil</a>
                            </li>
                                                                        </ul>
                            </ul>
            </div>

    <ul class="toc-footer" id="toc-footer">
                    <li style="padding-bottom: 5px;"><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li style="padding-bottom: 5px;"><a href="{{ route("scribe.openapi") }}">View OpenAPI spec</a></li>
                <li><a href="http://github.com/knuckleswtf/scribe">Documentation powered by Scribe ✍</a></li>
    </ul>

    <ul class="toc-footer" id="last-updated">
        <li>Last updated: September 21, 2026</li>
    </ul>
</div>

<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1 id="introduction">Introduction</h1>
<aside>
    <strong>Base URL</strong>: <code>http://localhost</code>
</aside>
<pre><code>This documentation aims to provide all the information you need to work with our API.

&lt;aside&gt;As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).&lt;/aside&gt;</code></pre>

        <h1 id="authenticating-requests">Authenticating requests</h1>
<p>This API is not authenticated.</p>

        <h1 id="authentication">Authentication</h1>

    <p>Endpoint untuk login, logout, dan cek data user yang sedang login.</p>

                                <h2 id="authentication-POSTapi-login">Login</h2>

<p>
</p>

<p>Login menggunakan username dan password, mengembalikan token akses.</p>

<span id="example-requests-POSTapi-login">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/login" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"username\": \"admin\",
    \"password\": \"password123\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/login"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "username": "admin",
    "password": "password123"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-login">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Login berhasil&quot;,
    &quot;token&quot;: &quot;1|xxxxxxxxxxxxxxxxxxxx&quot;,
    &quot;user&quot;: {
        &quot;id_pengguna&quot;: 1,
        &quot;nama_pengguna&quot;: &quot;Admin Utama&quot;,
        &quot;username&quot;: &quot;admin&quot;
    }
}</code>
 </pre>
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Username atau kata sandi salah.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-login" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-login"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-login"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-login" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-login">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-login" data-method="POST"
      data-path="api/login"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-login', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-login"
                    onclick="tryItOut('POSTapi-login');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-login"
                    onclick="cancelTryOut('POSTapi-login');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-login"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/login</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-login"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>username</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="username"                data-endpoint="POSTapi-login"
               value="admin"
               data-component="body">
    <br>
<p>Username pengguna. Example: <code>admin</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>password</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="password"                data-endpoint="POSTapi-login"
               value="password123"
               data-component="body">
    <br>
<p>Kata sandi pengguna. Example: <code>password123</code></p>
        </div>
        </form>

                    <h2 id="authentication-POSTapi-register">Ajukan Akun Baru</h2>

<p>
</p>

<p>Mengajukan akun baru untuk instansi/unit layanan. Status awal "pending", menunggu persetujuan admin.</p>

<span id="example-requests-POSTapi-register">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/register" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"level_akun\": 2,
    \"instansi_level_1\": 1,
    \"instansi_level_2\": 3,
    \"email\": \"organisasi@batam.go.id\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/register"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "level_akun": 2,
    "instansi_level_1": 1,
    "instansi_level_2": 3,
    "email": "organisasi@batam.go.id"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-register">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Pengajuan akun berhasil dikirim. Menunggu persetujuan admin.&quot;
}</code>
 </pre>
            <blockquote>
            <p>Example response (422):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Instansi ini sudah punya pengajuan yang masih menunggu persetujuan.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-register" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-register"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-register"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-register" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-register">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-register" data-method="POST"
      data-path="api/register"
      data-authed="0"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-register', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-register"
                    onclick="tryItOut('POSTapi-register');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-register"
                    onclick="cancelTryOut('POSTapi-register');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-register"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/register</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-register"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>level_akun</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="level_akun"                data-endpoint="POSTapi-register"
               value="2"
               data-component="body">
    <br>
<p>Level akun, 1 atau 2. Example: <code>2</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>instansi_level_1</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="instansi_level_1"                data-endpoint="POSTapi-register"
               value="1"
               data-component="body">
    <br>
<p>ID instansi level 1. Example: <code>1</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>instansi_level_2</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="instansi_level_2"                data-endpoint="POSTapi-register"
               value="3"
               data-component="body">
    <br>
<p>ID instansi level 2, wajib jika level_akun = 2. Example: <code>3</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="POSTapi-register"
               value="organisasi@batam.go.id"
               data-component="body">
    <br>
<p>Email pemohon. Example: <code>organisasi@batam.go.id</code></p>
        </div>
        </form>

                    <h2 id="authentication-GETapi-user">Data user saat ini</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Mengambil data user yang sedang login berdasarkan token.</p>

<span id="example-requests-GETapi-user">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/user" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/user"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-user">
            <blockquote>
            <p>Example response (401):</p>
        </blockquote>
                <details class="annotation">
            <summary style="cursor: pointer;">
                <small onclick="textContent = parentElement.parentElement.open ? 'Show headers' : 'Hide headers'">Show headers</small>
            </summary>
            <pre><code class="language-http">cache-control: no-cache, private
content-type: application/json
access-control-allow-origin: *
 </code></pre></details>         <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Unauthenticated.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-user" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-user"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-user"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-user" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-user">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-user" data-method="GET"
      data-path="api/user"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-user', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-user"
                    onclick="tryItOut('GETapi-user');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-user"
                    onclick="cancelTryOut('GETapi-user');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-user"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/user</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-user"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-user"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="authentication-POSTapi-logout">Logout</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Menghapus token akses yang sedang dipakai.</p>

<span id="example-requests-POSTapi-logout">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/logout" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/logout"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-logout">
</span>
<span id="execution-results-POSTapi-logout" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-logout"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-logout"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-logout" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-logout">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-logout" data-method="POST"
      data-path="api/logout"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-logout', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-logout"
                    onclick="tryItOut('POSTapi-logout');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-logout"
                    onclick="cancelTryOut('POSTapi-logout');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-logout"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/logout</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-logout"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                <h1 id="unit-layanan-perda">Unit Layanan - Perda</h1>

    <p>Endpoint untuk mengelola data Peraturan Daerah (Perda) milik instansi yang login.</p>

                                <h2 id="unit-layanan-perda-GETapi-unit-layanan-perda">Daftar Perda</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-unit-layanan-perda">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/unit-layanan/perda" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/unit-layanan/perda"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-unit-layanan-perda">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;tentang&quot;: &quot;Peraturan Daerah (Perda) Kota Batam Nomor 1 Tahun 2026 tentang Penyelenggaraan Administrasi Kependudukan&quot;
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-unit-layanan-perda" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-unit-layanan-perda"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-unit-layanan-perda"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-unit-layanan-perda" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-unit-layanan-perda">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-unit-layanan-perda" data-method="GET"
      data-path="api/unit-layanan/perda"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-unit-layanan-perda', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-unit-layanan-perda"
                    onclick="tryItOut('GETapi-unit-layanan-perda');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-unit-layanan-perda"
                    onclick="cancelTryOut('GETapi-unit-layanan-perda');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-unit-layanan-perda"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/unit-layanan/perda</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-unit-layanan-perda"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-unit-layanan-perda"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="unit-layanan-perda-POSTapi-unit-layanan-perda">Tambah Perda</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-unit-layanan-perda">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/unit-layanan/perda" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"tentang\": \"Peraturan Daerah (Perda) Kota Batam Nomor 1 Tahun 2026 tentang Penyelenggaraan Administrasi Kependudukan\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/unit-layanan/perda"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "tentang": "Peraturan Daerah (Perda) Kota Batam Nomor 1 Tahun 2026 tentang Penyelenggaraan Administrasi Kependudukan"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-unit-layanan-perda">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Peraturan Daerah berhasil ditambahkan.&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;tentang&quot;: &quot;Peraturan Daerah (Perda) Kota Batam Nomor 1 Tahun 2026 tentang Penyelenggaraan Administrasi Kependudukan&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-unit-layanan-perda" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-unit-layanan-perda"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-unit-layanan-perda"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-unit-layanan-perda" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-unit-layanan-perda">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-unit-layanan-perda" data-method="POST"
      data-path="api/unit-layanan/perda"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-unit-layanan-perda', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-unit-layanan-perda"
                    onclick="tryItOut('POSTapi-unit-layanan-perda');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-unit-layanan-perda"
                    onclick="cancelTryOut('POSTapi-unit-layanan-perda');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-unit-layanan-perda"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/unit-layanan/perda</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-unit-layanan-perda"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-unit-layanan-perda"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tentang</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="tentang"                data-endpoint="POSTapi-unit-layanan-perda"
               value="Peraturan Daerah (Perda) Kota Batam Nomor 1 Tahun 2026 tentang Penyelenggaraan Administrasi Kependudukan"
               data-component="body">
    <br>
<p>Isi lengkap peraturan (nomor, tahun, tentang apa). Example: <code>Peraturan Daerah (Perda) Kota Batam Nomor 1 Tahun 2026 tentang Penyelenggaraan Administrasi Kependudukan</code></p>
        </div>
        </form>

                    <h2 id="unit-layanan-perda-PUTapi-unit-layanan-perda--id-">Perbarui Perda</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-unit-layanan-perda--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/unit-layanan/perda/16" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"tentang\": \"Peraturan Daerah (Perda) Kota Batam Nomor 1 Tahun 2026 tentang Penyelenggaraan Administrasi Kependudukan (revisi)\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/unit-layanan/perda/16"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "tentang": "Peraturan Daerah (Perda) Kota Batam Nomor 1 Tahun 2026 tentang Penyelenggaraan Administrasi Kependudukan (revisi)"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-unit-layanan-perda--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Peraturan Daerah berhasil diperbarui.&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;tentang&quot;: &quot;Peraturan Daerah (Perda) Kota Batam Nomor 1 Tahun 2026 tentang Penyelenggaraan Administrasi Kependudukan (revisi)&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-unit-layanan-perda--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-unit-layanan-perda--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-unit-layanan-perda--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-unit-layanan-perda--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-unit-layanan-perda--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-unit-layanan-perda--id-" data-method="PUT"
      data-path="api/unit-layanan/perda/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-unit-layanan-perda--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-unit-layanan-perda--id-"
                    onclick="tryItOut('PUTapi-unit-layanan-perda--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-unit-layanan-perda--id-"
                    onclick="cancelTryOut('PUTapi-unit-layanan-perda--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-unit-layanan-perda--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/unit-layanan/perda/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-unit-layanan-perda--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-unit-layanan-perda--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-unit-layanan-perda--id-"
               value="16"
               data-component="url">
    <br>
<p>The ID of the perda. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>perda</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="perda"                data-endpoint="PUTapi-unit-layanan-perda--id-"
               value="1"
               data-component="url">
    <br>
<p>ID Perda. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tentang</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="tentang"                data-endpoint="PUTapi-unit-layanan-perda--id-"
               value="Peraturan Daerah (Perda) Kota Batam Nomor 1 Tahun 2026 tentang Penyelenggaraan Administrasi Kependudukan (revisi)"
               data-component="body">
    <br>
<p>Isi lengkap peraturan yang diperbarui. Example: <code>Peraturan Daerah (Perda) Kota Batam Nomor 1 Tahun 2026 tentang Penyelenggaraan Administrasi Kependudukan (revisi)</code></p>
        </div>
        </form>

                    <h2 id="unit-layanan-perda-DELETEapi-unit-layanan-perda--id-">Hapus Perda</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-unit-layanan-perda--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/unit-layanan/perda/16" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/unit-layanan/perda/16"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-unit-layanan-perda--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Peraturan Daerah berhasil dihapus.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-unit-layanan-perda--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-unit-layanan-perda--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-unit-layanan-perda--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-unit-layanan-perda--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-unit-layanan-perda--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-unit-layanan-perda--id-" data-method="DELETE"
      data-path="api/unit-layanan/perda/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-unit-layanan-perda--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-unit-layanan-perda--id-"
                    onclick="tryItOut('DELETEapi-unit-layanan-perda--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-unit-layanan-perda--id-"
                    onclick="cancelTryOut('DELETEapi-unit-layanan-perda--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-unit-layanan-perda--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/unit-layanan/perda/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-unit-layanan-perda--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-unit-layanan-perda--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-unit-layanan-perda--id-"
               value="16"
               data-component="url">
    <br>
<p>The ID of the perda. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>perda</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="perda"                data-endpoint="DELETEapi-unit-layanan-perda--id-"
               value="1"
               data-component="url">
    <br>
<p>ID Perda. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="unit-layanan-perwali">Unit Layanan - Perwali</h1>

    <p>Endpoint untuk mengelola data Peraturan Wali Kota (Perwali) milik instansi yang login.</p>

                                <h2 id="unit-layanan-perwali-GETapi-unit-layanan-perwali">Daftar Perwali</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-GETapi-unit-layanan-perwali">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/unit-layanan/perwali" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/unit-layanan/perwali"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-unit-layanan-perwali">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;data&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;tentang&quot;: &quot;Peraturan Walikota (Perwali) Kota Batam Nomor 4 Tahun 2025 tentang Perubahan Atas Peraturan Wali Kota Batam Nomor 47 Tahun 2023 Tentang Penyelenggaraan Pengelolaan Tanah Di Atas Hak Pengelolaan Pemerintah Kota Batam&quot;
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-unit-layanan-perwali" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-unit-layanan-perwali"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-unit-layanan-perwali"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-unit-layanan-perwali" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-unit-layanan-perwali">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-unit-layanan-perwali" data-method="GET"
      data-path="api/unit-layanan/perwali"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-unit-layanan-perwali', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-unit-layanan-perwali"
                    onclick="tryItOut('GETapi-unit-layanan-perwali');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-unit-layanan-perwali"
                    onclick="cancelTryOut('GETapi-unit-layanan-perwali');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-unit-layanan-perwali"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/unit-layanan/perwali</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-unit-layanan-perwali"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-unit-layanan-perwali"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="unit-layanan-perwali-POSTapi-unit-layanan-perwali">Tambah Perwali</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-POSTapi-unit-layanan-perwali">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request POST \
    "http://localhost/api/unit-layanan/perwali" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"tentang\": \"Peraturan Walikota (Perwali) Kota Batam Nomor 4 Tahun 2025 tentang Perubahan Atas Peraturan Wali Kota Batam Nomor 47 Tahun 2023 Tentang Penyelenggaraan Pengelolaan Tanah Di Atas Hak Pengelolaan Pemerintah Kota Batam\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/unit-layanan/perwali"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "tentang": "Peraturan Walikota (Perwali) Kota Batam Nomor 4 Tahun 2025 tentang Perubahan Atas Peraturan Wali Kota Batam Nomor 47 Tahun 2023 Tentang Penyelenggaraan Pengelolaan Tanah Di Atas Hak Pengelolaan Pemerintah Kota Batam"
};

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-POSTapi-unit-layanan-perwali">
            <blockquote>
            <p>Example response (201):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Peraturan Wali Kota berhasil ditambahkan.&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;tentang&quot;: &quot;Peraturan Walikota (Perwali) Kota Batam Nomor 4 Tahun 2025 tentang Perubahan Atas Peraturan Wali Kota Batam Nomor 47 Tahun 2023 Tentang Penyelenggaraan Pengelolaan Tanah Di Atas Hak Pengelolaan Pemerintah Kota Batam&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-POSTapi-unit-layanan-perwali" hidden>
    <blockquote>Received response<span
                id="execution-response-status-POSTapi-unit-layanan-perwali"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-unit-layanan-perwali"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-POSTapi-unit-layanan-perwali" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-unit-layanan-perwali">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-POSTapi-unit-layanan-perwali" data-method="POST"
      data-path="api/unit-layanan/perwali"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('POSTapi-unit-layanan-perwali', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-POSTapi-unit-layanan-perwali"
                    onclick="tryItOut('POSTapi-unit-layanan-perwali');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-POSTapi-unit-layanan-perwali"
                    onclick="cancelTryOut('POSTapi-unit-layanan-perwali');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-POSTapi-unit-layanan-perwali"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-black">POST</small>
            <b><code>api/unit-layanan/perwali</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="POSTapi-unit-layanan-perwali"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="POSTapi-unit-layanan-perwali"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tentang</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="tentang"                data-endpoint="POSTapi-unit-layanan-perwali"
               value="Peraturan Walikota (Perwali) Kota Batam Nomor 4 Tahun 2025 tentang Perubahan Atas Peraturan Wali Kota Batam Nomor 47 Tahun 2023 Tentang Penyelenggaraan Pengelolaan Tanah Di Atas Hak Pengelolaan Pemerintah Kota Batam"
               data-component="body">
    <br>
<p>Isi lengkap peraturan (nomor, tahun, tentang apa). Example: <code>Peraturan Walikota (Perwali) Kota Batam Nomor 4 Tahun 2025 tentang Perubahan Atas Peraturan Wali Kota Batam Nomor 47 Tahun 2023 Tentang Penyelenggaraan Pengelolaan Tanah Di Atas Hak Pengelolaan Pemerintah Kota Batam</code></p>
        </div>
        </form>

                    <h2 id="unit-layanan-perwali-PUTapi-unit-layanan-perwali--id-">Perbarui Perwali</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-unit-layanan-perwali--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/unit-layanan/perwali/16" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"tentang\": \"Peraturan Walikota (Perwali) Kota Batam Nomor 4 Tahun 2025 tentang Perubahan Atas Peraturan Wali Kota Batam Nomor 47 Tahun 2023 Tentang Penyelenggaraan Pengelolaan Tanah Di Atas Hak Pengelolaan Pemerintah Kota Batam (revisi)\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/unit-layanan/perwali/16"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "tentang": "Peraturan Walikota (Perwali) Kota Batam Nomor 4 Tahun 2025 tentang Perubahan Atas Peraturan Wali Kota Batam Nomor 47 Tahun 2023 Tentang Penyelenggaraan Pengelolaan Tanah Di Atas Hak Pengelolaan Pemerintah Kota Batam (revisi)"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-unit-layanan-perwali--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Peraturan Wali Kota berhasil diperbarui.&quot;,
    &quot;data&quot;: {
        &quot;id&quot;: 1,
        &quot;tentang&quot;: &quot;Peraturan Walikota (Perwali) Kota Batam Nomor 4 Tahun 2025 tentang Perubahan Atas Peraturan Wali Kota Batam Nomor 47 Tahun 2023 Tentang Penyelenggaraan Pengelolaan Tanah Di Atas Hak Pengelolaan Pemerintah Kota Batam (revisi)&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-unit-layanan-perwali--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-unit-layanan-perwali--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-unit-layanan-perwali--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-unit-layanan-perwali--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-unit-layanan-perwali--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-unit-layanan-perwali--id-" data-method="PUT"
      data-path="api/unit-layanan/perwali/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-unit-layanan-perwali--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-unit-layanan-perwali--id-"
                    onclick="tryItOut('PUTapi-unit-layanan-perwali--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-unit-layanan-perwali--id-"
                    onclick="cancelTryOut('PUTapi-unit-layanan-perwali--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-unit-layanan-perwali--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/unit-layanan/perwali/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-unit-layanan-perwali--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-unit-layanan-perwali--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="PUTapi-unit-layanan-perwali--id-"
               value="16"
               data-component="url">
    <br>
<p>The ID of the perwali. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>perwali</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="perwali"                data-endpoint="PUTapi-unit-layanan-perwali--id-"
               value="1"
               data-component="url">
    <br>
<p>ID Perwali. Example: <code>1</code></p>
            </div>
                            <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>tentang</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="tentang"                data-endpoint="PUTapi-unit-layanan-perwali--id-"
               value="Peraturan Walikota (Perwali) Kota Batam Nomor 4 Tahun 2025 tentang Perubahan Atas Peraturan Wali Kota Batam Nomor 47 Tahun 2023 Tentang Penyelenggaraan Pengelolaan Tanah Di Atas Hak Pengelolaan Pemerintah Kota Batam (revisi)"
               data-component="body">
    <br>
<p>Isi lengkap peraturan yang diperbarui. Example: <code>Peraturan Walikota (Perwali) Kota Batam Nomor 4 Tahun 2025 tentang Perubahan Atas Peraturan Wali Kota Batam Nomor 47 Tahun 2023 Tentang Penyelenggaraan Pengelolaan Tanah Di Atas Hak Pengelolaan Pemerintah Kota Batam (revisi)</code></p>
        </div>
        </form>

                    <h2 id="unit-layanan-perwali-DELETEapi-unit-layanan-perwali--id-">Hapus Perwali</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-DELETEapi-unit-layanan-perwali--id-">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request DELETE \
    "http://localhost/api/unit-layanan/perwali/16" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/unit-layanan/perwali/16"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "DELETE",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-DELETEapi-unit-layanan-perwali--id-">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Peraturan Wali Kota berhasil dihapus.&quot;
}</code>
 </pre>
    </span>
<span id="execution-results-DELETEapi-unit-layanan-perwali--id-" hidden>
    <blockquote>Received response<span
                id="execution-response-status-DELETEapi-unit-layanan-perwali--id-"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-DELETEapi-unit-layanan-perwali--id-"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-DELETEapi-unit-layanan-perwali--id-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-DELETEapi-unit-layanan-perwali--id-">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-DELETEapi-unit-layanan-perwali--id-" data-method="DELETE"
      data-path="api/unit-layanan/perwali/{id}"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('DELETEapi-unit-layanan-perwali--id-', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-DELETEapi-unit-layanan-perwali--id-"
                    onclick="tryItOut('DELETEapi-unit-layanan-perwali--id-');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-DELETEapi-unit-layanan-perwali--id-"
                    onclick="cancelTryOut('DELETEapi-unit-layanan-perwali--id-');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-DELETEapi-unit-layanan-perwali--id-"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-red">DELETE</small>
            <b><code>api/unit-layanan/perwali/{id}</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="DELETEapi-unit-layanan-perwali--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="DELETEapi-unit-layanan-perwali--id-"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        <h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>id</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="id"                data-endpoint="DELETEapi-unit-layanan-perwali--id-"
               value="16"
               data-component="url">
    <br>
<p>The ID of the perwali. Example: <code>16</code></p>
            </div>
                    <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>perwali</code></b>&nbsp;&nbsp;
<small>integer</small>&nbsp;
 &nbsp;
 &nbsp;
                <input type="number" style="display: none"
               step="any"               name="perwali"                data-endpoint="DELETEapi-unit-layanan-perwali--id-"
               value="1"
               data-component="url">
    <br>
<p>ID Perwali. Example: <code>1</code></p>
            </div>
                    </form>

                <h1 id="unit-layanan-profil">Unit Layanan - Profil</h1>

    <p>Endpoint untuk mengelola data Profil Unit Layanan beserta Perda &amp; Perwali terkait.</p>

                                <h2 id="unit-layanan-profil-GETapi-unit-layanan-profile">Ambil data profil</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>

<p>Mengambil data profil unit layanan beserta daftar Perda dan Perwali milik instansi yang login.</p>

<span id="example-requests-GETapi-unit-layanan-profile">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request GET \
    --get "http://localhost/api/unit-layanan/profile" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json"</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/unit-layanan/profile"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-GETapi-unit-layanan-profile">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;profile&quot;: {
        &quot;id&quot;: 1,
        &quot;id_instansi&quot;: 1,
        &quot;nama_unit&quot;: &quot;Bagian Organisasi&quot;,
        &quot;nama_kepala&quot;: &quot;Drs. Ahmad Fauzi, M.Si&quot;,
        &quot;jabatan&quot;: &quot;Non PLT&quot;,
        &quot;website&quot;: null,
        &quot;alamat&quot;: &quot;Jln Engku Putri&quot;,
        &quot;nip&quot;: &quot;19750101 200003 1 001&quot;,
        &quot;pangkat&quot;: &quot;Pembina Utama Muda (IV/c)&quot;,
        &quot;email&quot;: &quot;123@gmail.com&quot;,
        &quot;misi&quot;: &quot;bersikap baik&quot;,
        &quot;telepon&quot;: &quot;0899764532109&quot;,
        &quot;faksimile&quot;: &quot;(0778) 123457&quot;,
        &quot;motto&quot;: &quot;bersikap baik&quot;,
        &quot;visi&quot;: &quot;bersikap baik&quot;
    },
    &quot;perda&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;tentang&quot;: &quot;Peraturan Daerah (Perda) Kota Batam Nomor 1 Tahun 2026 tentang Penyelenggaraan Administrasi Kependudukan&quot;
        }
    ],
    &quot;perwali&quot;: [
        {
            &quot;id&quot;: 1,
            &quot;tentang&quot;: &quot;Peraturan Walikota (Perwali) Kota Batam Nomor 4 Tahun 2025 tentang Perubahan Atas Peraturan Wali Kota Batam Nomor 47 Tahun 2023 Tentang Penyelenggaraan Pengelolaan Tanah Di Atas Hak Pengelolaan Pemerintah Kota Batam&quot;
        }
    ]
}</code>
 </pre>
    </span>
<span id="execution-results-GETapi-unit-layanan-profile" hidden>
    <blockquote>Received response<span
                id="execution-response-status-GETapi-unit-layanan-profile"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-unit-layanan-profile"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-GETapi-unit-layanan-profile" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-unit-layanan-profile">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-GETapi-unit-layanan-profile" data-method="GET"
      data-path="api/unit-layanan/profile"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('GETapi-unit-layanan-profile', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-GETapi-unit-layanan-profile"
                    onclick="tryItOut('GETapi-unit-layanan-profile');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-GETapi-unit-layanan-profile"
                    onclick="cancelTryOut('GETapi-unit-layanan-profile');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-GETapi-unit-layanan-profile"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-green">GET</small>
            <b><code>api/unit-layanan/profile</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="GETapi-unit-layanan-profile"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="GETapi-unit-layanan-profile"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                        </form>

                    <h2 id="unit-layanan-profil-PUTapi-unit-layanan-profile">Simpan / perbarui profil</h2>

<p>
<small class="badge badge-darkred">requires authentication</small>
</p>



<span id="example-requests-PUTapi-unit-layanan-profile">
<blockquote>Example request:</blockquote>


<div class="bash-example">
    <pre><code class="language-bash">curl --request PUT \
    "http://localhost/api/unit-layanan/profile" \
    --header "Content-Type: application/json" \
    --header "Accept: application/json" \
    --data "{
    \"nama_unit\": \"Bagian Organisasi\",
    \"nama_kepala\": \"Drs. Ahmad Fauzi, M.Si\",
    \"jabatan\": \"Non PLT\",
    \"website\": \"architecto\",
    \"alamat\": \"architecto\",
    \"nip\": \"architecto\",
    \"pangkat\": \"architecto\",
    \"email\": \"gbailey@example.net\",
    \"misi\": \"architecto\",
    \"telepon\": \"architecto\",
    \"faksimile\": \"architecto\",
    \"motto\": \"architecto\",
    \"visi\": \"architecto\"
}"
</code></pre></div>


<div class="javascript-example">
    <pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/unit-layanan/profile"
);

const headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "nama_unit": "Bagian Organisasi",
    "nama_kepala": "Drs. Ahmad Fauzi, M.Si",
    "jabatan": "Non PLT",
    "website": "architecto",
    "alamat": "architecto",
    "nip": "architecto",
    "pangkat": "architecto",
    "email": "gbailey@example.net",
    "misi": "architecto",
    "telepon": "architecto",
    "faksimile": "architecto",
    "motto": "architecto",
    "visi": "architecto"
};

fetch(url, {
    method: "PUT",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre></div>

</span>

<span id="example-responses-PUTapi-unit-layanan-profile">
            <blockquote>
            <p>Example response (200):</p>
        </blockquote>
                <pre>

<code class="language-json" style="max-height: 300px;">{
    &quot;message&quot;: &quot;Data profil berhasil disimpan.&quot;,
    &quot;profile&quot;: {
        &quot;id&quot;: 1,
        &quot;id_instansi&quot;: 1,
        &quot;nama_unit&quot;: &quot;Bagian Organisasi&quot;
    }
}</code>
 </pre>
    </span>
<span id="execution-results-PUTapi-unit-layanan-profile" hidden>
    <blockquote>Received response<span
                id="execution-response-status-PUTapi-unit-layanan-profile"></span>:
    </blockquote>
    <pre class="json"><code id="execution-response-content-PUTapi-unit-layanan-profile"
      data-empty-response-text="<Empty response>" style="max-height: 400px;"></code></pre>
</span>
<span id="execution-error-PUTapi-unit-layanan-profile" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-PUTapi-unit-layanan-profile">

Tip: Check that you&#039;re properly connected to the network.
If you&#039;re a maintainer of ths API, verify that your API is running and you&#039;ve enabled CORS.
You can check the Dev Tools console for debugging information.</code></pre>
</span>
<form id="form-PUTapi-unit-layanan-profile" data-method="PUT"
      data-path="api/unit-layanan/profile"
      data-authed="1"
      data-hasfiles="0"
      data-isarraybody="0"
      autocomplete="off"
      onsubmit="event.preventDefault(); executeTryOut('PUTapi-unit-layanan-profile', this);">
    <h3>
        Request&nbsp;&nbsp;&nbsp;
                    <button type="button"
                    style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-tryout-PUTapi-unit-layanan-profile"
                    onclick="tryItOut('PUTapi-unit-layanan-profile');">Try it out ⚡
            </button>
            <button type="button"
                    style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-canceltryout-PUTapi-unit-layanan-profile"
                    onclick="cancelTryOut('PUTapi-unit-layanan-profile');" hidden>Cancel 🛑
            </button>&nbsp;&nbsp;
            <button type="submit"
                    style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;"
                    id="btn-executetryout-PUTapi-unit-layanan-profile"
                    data-initial-text="Send Request 💥"
                    data-loading-text="⏱ Sending..."
                    hidden>Send Request 💥
            </button>
            </h3>
            <p>
            <small class="badge badge-darkblue">PUT</small>
            <b><code>api/unit-layanan/profile</code></b>
        </p>
                <h4 class="fancy-heading-panel"><b>Headers</b></h4>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Content-Type</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Content-Type"                data-endpoint="PUTapi-unit-layanan-profile"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <div style="padding-left: 28px; clear: unset;">
                <b style="line-height: 2;"><code>Accept</code></b>&nbsp;&nbsp;
&nbsp;
 &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="Accept"                data-endpoint="PUTapi-unit-layanan-profile"
               value="application/json"
               data-component="header">
    <br>
<p>Example: <code>application/json</code></p>
            </div>
                                <h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
        <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>nama_unit</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="nama_unit"                data-endpoint="PUTapi-unit-layanan-profile"
               value="Bagian Organisasi"
               data-component="body">
    <br>
<p>Nama unit layanan. Example: <code>Bagian Organisasi</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>nama_kepala</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="nama_kepala"                data-endpoint="PUTapi-unit-layanan-profile"
               value="Drs. Ahmad Fauzi, M.Si"
               data-component="body">
    <br>
<p>Nama kepala dinas/UUP. Example: <code>Drs. Ahmad Fauzi, M.Si</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>jabatan</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="jabatan"                data-endpoint="PUTapi-unit-layanan-profile"
               value="Non PLT"
               data-component="body">
    <br>
<p>Salah satu dari: Non PLT, PLT. Example: <code>Non PLT</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>website</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="website"                data-endpoint="PUTapi-unit-layanan-profile"
               value="architecto"
               data-component="body">
    <br>
<p>Laman/website unit layanan. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>alamat</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="alamat"                data-endpoint="PUTapi-unit-layanan-profile"
               value="architecto"
               data-component="body">
    <br>
<p>Alamat unit layanan. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>nip</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="nip"                data-endpoint="PUTapi-unit-layanan-profile"
               value="architecto"
               data-component="body">
    <br>
<p>NIP kepala dinas. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>pangkat</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="pangkat"                data-endpoint="PUTapi-unit-layanan-profile"
               value="architecto"
               data-component="body">
    <br>
<p>Pangkat kepala dinas. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>email</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="email"                data-endpoint="PUTapi-unit-layanan-profile"
               value="gbailey@example.net"
               data-component="body">
    <br>
<p>Email unit layanan. Example: <code>gbailey@example.net</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>misi</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="misi"                data-endpoint="PUTapi-unit-layanan-profile"
               value="architecto"
               data-component="body">
    <br>
<p>Misi unit layanan. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>telepon</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="telepon"                data-endpoint="PUTapi-unit-layanan-profile"
               value="architecto"
               data-component="body">
    <br>
<p>Nomor telepon. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>faksimile</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="faksimile"                data-endpoint="PUTapi-unit-layanan-profile"
               value="architecto"
               data-component="body">
    <br>
<p>Nomor faksimile. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>motto</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="motto"                data-endpoint="PUTapi-unit-layanan-profile"
               value="architecto"
               data-component="body">
    <br>
<p>Motto unit layanan. Example: <code>architecto</code></p>
        </div>
                <div style=" padding-left: 28px;  clear: unset;">
            <b style="line-height: 2;"><code>visi</code></b>&nbsp;&nbsp;
<small>string</small>&nbsp;
<i>optional</i> &nbsp;
 &nbsp;
                <input type="text" style="display: none"
                              name="visi"                data-endpoint="PUTapi-unit-layanan-profile"
               value="architecto"
               data-component="body">
    <br>
<p>Visi unit layanan. Example: <code>architecto</code></p>
        </div>
        </form>

            

        
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                                        <button type="button" class="lang-button" data-language-name="bash">bash</button>
                                                        <button type="button" class="lang-button" data-language-name="javascript">javascript</button>
                            </div>
            </div>
</div>
</body>
</html>
