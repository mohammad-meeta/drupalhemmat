<h1 class="pb-2 border-bottom">
    @{{ pageTitle }}
    <span v-if="isEditMode">
        @{{ newDepartment.oldTitle }}
    </span>
</h1>

<nav class="nav">
    <li class="nav-item">
        <div v-if="savingSuccess" class="alert alert-success" role="alert">
           قسمت @{{ newDepartment.title }} با موفقیت ثبت شد.
        </div>
        <a v-show="isListMode" class="nav-link active" href="#" @click.prevent="showCreateForm">
            ثبت قسمت جدید
        </a>
    </li>
</nav>
