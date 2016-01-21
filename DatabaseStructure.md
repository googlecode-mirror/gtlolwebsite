# Information #
DB Name: gtlol

# Tables #
## Users ##
<table cellpadding='4px' border='1px'>
<blockquote><tr>
<blockquote><th>id</th>
<th>username</th>
<th>name</th>
<th>email</th>
<th>password</th>
<th>email_is_validated</th>
</blockquote></tr>
<tr>
<blockquote><td>integer</td>
<td>varchar(30)</td>
<td>varchar(50)</td>
<td>varchar(100)</td>
<td>varchar(50)</td>
<td>boolean</td>
</blockquote></tr>
<tr>
<blockquote><td>Primary Key</td>
<td></td>
<td></td>
<td></td>
<td>php crypt()</td>
<td></td>
</blockquote></tr>
</table></blockquote>

## Roles ##

<table cellpadding='4px' border='1px'>
<blockquote><tr>
<blockquote><th>id</th>
<th>name</th>
</blockquote></tr>
<tr>
<blockquote><td>Primary Key</td>
<td>varchar(30)</td>
</blockquote></tr>
</table></blockquote>

## UserRoles ##

<table cellpadding='4px' border='1px'>
<blockquote><tr>
<blockquote><th>user_id</th>
<th>role_id</th>
</blockquote></tr>
<tr>
<blockquote><td>Composite Primary Key</td>
<td>Composite Primary Key</td>
</blockquote></tr>
<tr>
<blockquote><td>Foreign Key (Users.id)</td>
<td>Foreign Key (Roles.id)</td>
</blockquote></tr>
</table></blockquote>

Users can have multiple roles.

## Announcements ##

<table cellpadding='4px' border='1px'>
<blockquote><tr>
<blockquote><th>id</th>
<th>announcer_id</th>
<th>title</th>
<th>announcement</th>
<th>created_date</th>
</blockquote></tr>
<tr>
<blockquote><td>Primary Key</td>
<td>Foreign Key (Users.id)</td>
<td>varchar(255)</td>
<td>Text</td>
<td>DateTime</td>
</blockquote></tr>
<tr>
<blockquote><td></td>
<td>Not Null</td>
<td>Not Null</td>
<td>Not Null</td>
<td>Not Null</td>
</blockquote></tr>
</table>