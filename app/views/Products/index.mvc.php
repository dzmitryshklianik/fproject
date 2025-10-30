{% extends "base.mvc.php" %}

{% block title %}Products{% endblock %}

{% block body %}

<h1>Products</h1>

<a href="/products/new">New Product</a>

<p> Total: {{ $total }}</p>


{% foreach ($products as $product): %}
    <a href="/products/{{ $product['id'] }}/show">
        <h2>{{ $product['name'] }}</h2>
    </a>
{% endforeach; %}

{% endblock %}