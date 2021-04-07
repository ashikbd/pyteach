@include('emails.header')
Hello Admin,<br />
You received a message from : {{ $email->name }}

<p>
User Name: {{ $email->name }}
</p>

<p>
User Email: {{ $email->email }}
</p>
<p>
Order No: {{ $email->order_no }}
</p>
<p>
Subject: {{ $email->subject }}
</p>
<p>
Message provided: {{ $email->message }}
</p>
<p>
User IP: {{ $email->user_ip }}
</p>
<small>
This message was submitted from {{url('contact-us')}}
</small>
</td>
</tr>
</tbody>
</table>
<!-- Here Goes Content: End -->
@include('emails.footer')
