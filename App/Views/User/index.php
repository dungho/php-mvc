{% extends "base.html" %}
{% block body %}
<ul>
    {% for user in users %}
        <li>
            {{ user['name']}}
        </li>
    {% endfor %}
</ul>
{% endblock %}