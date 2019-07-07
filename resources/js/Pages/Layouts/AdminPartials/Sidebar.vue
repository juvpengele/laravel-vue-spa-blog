<template>
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
        <div class="sidebar-sticky">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <router-link to="/admin" class="nav-link active text-info">
                        <i class="fa fa-dashboard "></i>
                        Dashboard <span class="sr-only">(current)</span>
                    </router-link>
                </li>
            </ul>
            <span class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>Categories</span>
            </span>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <router-link class="nav-link text-info" :to="{name: 'admin.categories.create'}">
                        <i class="fa fa-plus-circle"></i>
                        Add Categories
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link :to="{ name: 'admin.categories.index'}" class="nav-link text-info">
                        <i class="fa fa-list-ul"></i>
                        Manage categories
                    </router-link>
                </li>
            </ul>
            <span class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>Posts</span>
            </span>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <router-link class="nav-link text-info" :to="{name: 'admin.posts.create'}">
                        <i class="fa fa-plus-circle"></i>
                        Add posts
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link :to="{ name: 'admin.posts.index'}" class="nav-link text-info">
                        <i class="fa fa-list-ul"></i>
                        Manage posts
                    </router-link>
                </li>
            </ul>
            <span class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>Tags</span>
            </span>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <router-link :to="{ name: 'admin.tags.index'}" class="nav-link text-info">
                        <i class="fa fa-tags"></i>
                        Manage tags
                    </router-link>
                </li>
            </ul>
            <span class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>Comments</span>
            </span>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <router-link :to="{ name: 'admin.comments.index'}" class="nav-link text-info">
                        <i class="fa fa-comments"></i>
                        Manage comments
                    </router-link>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>

    export default {
        name: "Sidebar",
    }
</script>

<style scoped>
    .sidebar-sticky i {
        font-size: 19px;
    }
</style>