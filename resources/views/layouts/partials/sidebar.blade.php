<div class="bg-light border-end" id="sidebar-wrapper">
    <div class="sidebar-heading p-3">Dashboard</div>
    <div class="list-group list-group-flush">
        @if(auth()->user()->isAdmin())
            <a href="{{ url('/admin/dashboard') }}" class="list-group-item list-group-item-action">Dashboard</a>
            <a href="{{ url('/admin/categories') }}" class="list-group-item list-group-item-action">Categories</a>
            <a href="{{ url('/admin/properties') }}" class="list-group-item list-group-item-action">Properties</a>
            <a href="{{ url('/admin/users') }}" class="list-group-item list-group-item-action">Users</a>
            <a href="{{ url('/admin/agent-requests') }}" class="list-group-item list-group-item-action">Agent Requests</a>
            <a href="{{ url('/admin/feedback') }}" class="list-group-item list-group-item-action">Feedback</a>
            <a href="{{ url('/admin/announcements') }}" class="list-group-item list-group-item-action">Announcements</a>
        @elseif(auth()->user()->isAgent())
            <a href="{{ url('/agent/dashboard') }}" class="list-group-item list-group-item-action">Dashboard</a>
            <a href="{{ url('/agent/properties') }}" class="list-group-item list-group-item-action">Properties</a>
            <a href="{{ url('/agent/queries') }}" class="list-group-item list-group-item-action">Queries</a>
        @else
            <a href="{{ url('/user/dashboard') }}" class="list-group-item list-group-item-action">Dashboard</a>
            <a href="{{ url('/user/properties') }}" class="list-group-item list-group-item-action">Properties</a>
            <a href="{{ url('/user/announcements') }}" class="list-group-item list-group-item-action">Announcements</a>
            <a href="{{ url('/user/profile') }}" class="list-group-item list-group-item-action">Profile</a>
        @endif
    </div>
</div>
