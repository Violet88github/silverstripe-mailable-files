<% loop $Files %>
[$Name][$Pos]
<% end_loop %>

<% loop $Files %>
[$Pos]: $File.AbsoluteLink
<% end_loop %>
