<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages</title>
    <style>
        /* Basic styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            text-align: center; /* Center align content */
        }

        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
            text-align: left; /* Reset text alignment for container content */
        }

        .company-name {
            font-weight: bold;
            color: #333;
            cursor: pointer;
            display: inline-block; /* Ensure proper alignment */
            margin-right: 10px; /* Add spacing between company name and count */
        }

        .unread-count {
            color: #ff0000; /* Red color for unread count */
        }

        .message-content {
            margin-left: 20px;
            display: none; /* Hide message content by default */
        }

        .unread {
            font-weight: bold;
            color: #0000ff; /* Blue color for unread messages */
        }

        .pagination {
            margin-top: 20px;
        }
        .search-box {
    margin-bottom: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.search-box input[type="text"],
.search-box button {
    display: inline-block;
    vertical-align: middle;
}


        /* Center align message title */
        h1 {
            text-align: center;
        }
        .messages {
        text-align: center; /* Center align messages */
    }

    .no-messages {
        position: absolute; /* Position the "No messages" paragraph */
        top: 50%; /* Center vertically */
        left: 50%; /* Center horizontally */
        transform: translate(-50%, -50%); /* Center the paragraph */
        font-style: italic; /* Italicize the text */
        color: #999; /* Light gray color */
    }

    .no-messages::before {
        content: "No messages"; /* Add content */
    }
    </style>
</head>
<body>
@include('job.jobnavigationbar')

    <div class="container">
        <h1>Messages</h1>

        <!-- Search box -->
        <div class="search-box">
            <input type="text" id="searchInput" placeholder="Search...">
            <button onclick="searchMessages()">Search</button>
        </div>

        <!-- Messages -->
        
    <!-- Messages -->
    <div class="messages">
        @php
            $groupedMessages = $messages->groupBy('company.company_name');
        @endphp

        @if ($groupedMessages->isEmpty())
            <p>No messages</p>
        @else
            @foreach($groupedMessages as $companyName => $companyMessages)
                @php
                    $unreadCount = $companyMessages->where('read_at', null)->count();
                @endphp

                <div class="message">
                    <p class="company-name" onclick="toggleMessages(this)">{{ $companyName }}
                        @if ($unreadCount > 0)
                            <span class="unread-count">({{ $unreadCount }})</span>
                        @endif
                    </p>
                    <div class="message-content">
                        @foreach($companyMessages as $message)
                            @php
                                $isRead = $message->read_at !== null;
                            @endphp

                            <p class="{{ $isRead ? '' : 'unread' }}">{{ $message->message }}</p>
                            <p>Sent at: {{ $message->created_at }}</p>
                        @endforeach
                    </div>
                </div>
            @endforeach
        @endif
    </div>

        <!-- Pagination -->
      
    </div>

    <script>
        function toggleMessages(element) {
            // Find the next sibling element with the class 'message-content'
            var messageContent = element.nextElementSibling;

            // Toggle the display style of the message content
            messageContent.style.display === 'none' ? messageContent.style.display = 'block' : messageContent.style.display = 'none';
        }

        function searchMessages() {
            var input, filter, messages, i, txtValue;
            input = document.getElementById('searchInput');
            filter = input.value.toUpperCase();
            messages = document.getElementsByClassName('message');

            for (i = 0; i < messages.length; i++) {
                txtValue = messages[i].textContent || messages[i].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    messages[i].style.display = "";
                } else {
                    messages[i].style.display = "none";
                }
            }
        }
    </script>
</body>
</html>
