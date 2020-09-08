<h2>Новое обращение Варендуру</h2>
<p>
    <strong>От:</strong> {{ $email->name }} (<italic>{{ $email->email }}</italic>)
</p>
<p>
    <strong>Тема:</strong> {{ $email->theme }}
</p>
<p>
    <strong>Сообщение:</strong>
</p>
<p>
    {{ $email->text }}
</p>