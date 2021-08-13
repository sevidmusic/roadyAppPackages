<div class="rr-docs-container">
    <div class="rr-docs-output">
        <h1 id="installation-setup-and-hello-world">Installation, setup, and Hello World</h1>
        <video class="rr-docs-video" controls autoplay>
            <source src="https://roadydemos.us-east-1.linodeobjects.com/roadyInstallAndHelloWorldTake3-2021-07-31_14.06.34.webm" type="video/webm">
            Sorry, the video failed to load.
        </video>
        <h3 id="install-setup">Install &amp; Setup</h3>
        <pre><code>
cd ~/

git clone https://github.com/sevidmusic/roady.git

cd ~/roady

composer update

export PATH=&quot;${PATH}:${HOME}/roady/vendor/darling/rig/bin&quot;

rig --help | more
        </code></pre>
        <h3 id="create-a-hello-world-app-and-build-it-for-the-domain-httplocalhost8080">Create a Hello World App and build it for the domain <code>http://localhost:8080</code></h3>
        <pre><code>
rig --configure-app-output --for-app HelloWorld --name HelloWorld --output &#39;&lt;p&gt;Hello World&lt;/p&gt;&#39; --relative-urls &#39;/&#39;

php ./Apps/HelloWorld/Components.php &#39;http://localhost:8080&#39;
        </code></pre>
        <h3 id="start-a-development-server">Start a development server</h3>
        <pre><code>
rig --start-server --port 8080 --open-in-browser
        </code></pre>
        <h3 id="edit-hello-worlds-output">Edit Hello World’s output</h3>
        <pre><code>
vim ./Apps/HelloWorld/DynamicOutput/HelloWorld.php
        </code></pre>
        <h3 id="helloworlddynamicoutputhelloworld.php">HelloWorld/DynamicOutput/HelloWorld.php</h3>
        <pre><code>
&lt;div class=&quot;container&quot;&gt;

    &lt;h1&gt;Roady&lt;/h1&gt;

    &lt;p&gt;
        &lt;a href=&quot;https://github.com/sevidmusic/roady&quot;&gt;Roady&lt;/a&gt; is a tool designed
        to aid in the development of websites.
    &lt;/p&gt;

    &lt;p&gt;
        Its design allows the features of a website to be implemented as
        smaller niche applications called Apps.
    &lt;/p&gt;

    &lt;p&gt;
        &lt;a href=&quot;https://github.com/sevidmusic/roady&quot;&gt;Roady&lt;/a&gt; Apps are responsible for implementing one or more related features.
    &lt;/p&gt;

    &lt;p&gt;
        The features of an App can be made available to multiple websites running on
        a single installation of the &lt;a href=&quot;https://github.com/sevidmusic/roady&quot;&gt;Roady&lt;/a&gt;.
    &lt;/p&gt;

    &lt;p&gt;
        Apps can configure output to show up in response to appropriate requests to a
        website, and can also provide stylesheets, scripts, and other resources
        necessary to implement the specific features they provide.
    &lt;/p&gt;

&lt;/div&gt;</code></pre>
        <h1 id="add-some-style">Add some style</h1>
        <pre><code>
vim ./Apps/HelloWorld/css/hw-global-styles.css
        </code></pre>
        <h3 id="hw-global-styles.css">hw-global-styles.css</h3>
        <pre><code>
body {
    background: #140a09;
    background-image: linear-gradient(45deg, #00bbff 25%, transparent 25%), linear-gradient(-45deg, #020203 25%, transparent 25%), linear-gradient(45deg, transparent 75%, #00bbff 75%), linear-gradient(-45deg, transparent 75%, #020203 75%);
    background-size: 10rem 10rem;
    background-position: 0 0, 0 10rem, 10rem -10rem, -10rem 0rem;
    color: #fa5f11;
    font-size: 1.2rem;
    font-family: monospace;
    padding: 0;
    margin: 0;
}

.container h1 {
    color: white;
}

.container {
    width: 80%;
    background: #010103;
    opacity: .72;
    margin: 3rem auto;
    padding: 3rem;
    border: .2rem double white;
}

.container a, .container a:link, .container a:visited {
    text-decoration: none;
    color: white;
}

.container a:hover, .container a:active {
    color: #00bbff;
}
</code></pre>
        <h3 id="hello-world-app-package">Hello World App Package</h3>
        <span class="rr-docs-note">Note:</span>
        <p>The <a href="index.php?request=AppPackages">App Package</a> for the HelloWorld App created in the example above can be found <a href="https://github.com/sevidmusic/roadyAppPackages/tree/main/HelloWorld">here</a>:</p>
        <p><a href="https://github.com/sevidmusic/roadyAppPackages/tree/main/HelloWorld">https://github.com/sevidmusic/roadyAppPackages/tree/main/HelloWorld</a></p>
        <p>And can be made into a Roady app via:</p>
        <code class="rr-docs-code"><a href="index.php?request=rig">rig</a> <a href="index.php?request=make-app-package">--make-app-package</a></code>
    </div>
</div>
