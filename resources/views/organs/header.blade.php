<h1 class="pb-2 border-bottom">
    @{{ pageTitle }}
</h1>

<nav class="nav">
    <li class="nav-item">
        <a v-show="isListMode" class="nav-link active" href="#" @click.prevent="showCreateForm">
            ثبت سازمان جدید
        </a>
    </li>
</nav>
