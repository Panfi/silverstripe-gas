<% if Message %>
    <div data-alert class='radius alert-box {$MessageType}' id='{$MessageType}Message'>
        $Message
        <a href="#" class="close">&times;</a>
    </div>
<% end_if %>