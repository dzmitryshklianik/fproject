{% extends "base.mvc.php" %}

{% block title %}Delete {{ $product['name'] }}{% endblock %}

{% block body %}

<h1>Delete {{ $product['name'] }}</h1>

<form method="post" action="/products/{{ $product["id"] }}/destroy">
    <p>Delete this product?</p>

    <button>Yes</button>
</form>

<p><a href="/products/{{ $product["id"] }}/show">Cancel</a></p>

{% endblock %}
