<div class="bg-dark text-white border-end" id="sidebar-wrapper" style="min-width: 250px;">
    <div class="sidebar-heading p-4 fs-4 fw-bold border-bottom border-secondary">
        <i class="bi bi-house-door text-primary"></i> RealEstate
    </div>
    <div class="list-group list-group-flush">
        @if(auth()->user()->isAdmin())
            <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action bg-dark text-white border-secondary py-3 px-4">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
            <a href="{{ route('admin.categories.index') }}" class="list-group-item list-group-item-action bg-dark text-white border-secondary py-3 px-4">
                <i class="bi bi-grid me-2"></i> Categories
            </a>
            <a href="{{ route('admin.properties.index') }}" class="list-group-item list-group-item-action bg-dark text-white border-secondary py-3 px-4">
                <i class="bi bi-building me-2"></i> Properties
            </a>
            <a href="{{ route('admin.orders.index') }}" class="list-group-item list-group-item-action bg-dark text-white border-secondary py-3 px-4">
                <i class="bi bi-cart me-2"></i> Purchase Orders
            </a>
            <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action bg-dark text-white border-secondary py-3 px-4">
                <i class="bi bi-people me-2"></i> Users
            </a>
            <a href="{{ route('admin.agent-requests.index') }}" class="list-group-item list-group-item-action bg-dark text-white border-secondary py-3 px-4">
                <i class="bi bi-person-check me-2"></i> Agent Requests
            </a>
            <a href="{{ route('admin.feedback.index') }}" class="list-group-item list-group-item-action bg-dark text-white border-secondary py-3 px-4">
                <i class="bi bi-chat-left-dots me-2"></i> Feedback
            </a>
            <a href="{{ route('admin.announcements.index') }}" class="list-group-item list-group-item-action bg-dark text-white border-secondary py-3 px-4">
                <i class="bi bi-megaphone me-2"></i> Announcements
            </a>
            <a href="{{ route('admin.profile.index') }}" class="list-group-item list-group-item-action bg-dark text-white border-secondary py-3 px-4">
                <i class="bi bi-person-circle me-2"></i> Profile
            </a>
        @elseif(auth()->user()->isAgent())
            <a href="{{ route('agent.dashboard') }}" class="list-group-item list-group-item-action bg-dark text-white border-secondary py-3 px-4">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
            <a href="{{ route('agent.properties.index') }}" class="list-group-item list-group-item-action bg-dark text-white border-secondary py-3 px-4">
                <i class="bi bi-building me-2"></i> My Properties
            </a>
            <a href="{{ route('agent.orders.index') }}" class="list-group-item list-group-item-action bg-dark text-white border-secondary py-3 px-4">
                <i class="bi bi-cart me-2"></i> Purchase Orders
            </a>
            <a href="{{ route('agent.queries.index') }}" class="list-group-item list-group-item-action bg-dark text-white border-secondary py-3 px-4">
                <i class="bi bi-envelope me-2"></i> Queries
            </a>
            <a href="{{ route('agent.profile.index') }}" class="list-group-item list-group-item-action bg-dark text-white border-secondary py-3 px-4">
                <i class="bi bi-person-circle me-2"></i> Profile
            </a>
        @else
            <a href="{{ route('user.dashboard') }}" class="list-group-item list-group-item-action bg-dark text-white border-secondary py-3 px-4">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
            <a href="{{ route('user.properties.index') }}" class="list-group-item list-group-item-action bg-dark text-white border-secondary py-3 px-4">
                <i class="bi bi-search me-2"></i> Browse Properties
            </a>
            <a href="{{ route('user.announcements.index') }}" class="list-group-item list-group-item-action bg-dark text-white border-secondary py-3 px-4">
                <i class="bi bi-megaphone me-2"></i> Announcements
            </a>
            <a href="{{ route('user.profile.index') }}" class="list-group-item list-group-item-action bg-dark text-white border-secondary py-3 px-4">
                <i class="bi bi-person-circle me-2"></i> Profile
            </a>
        @endif
    </div>
</div>
