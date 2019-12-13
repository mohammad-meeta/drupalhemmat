<template>
  <div>
    <h2 v-if="! hasRecord">اطلاعاتی وجود ندارد</h2>

    <table class="pp-striped-table" v-if="hasRecord">
      <thead>
        <tr>
          <th>عنوان</th>
          <th>نوع مطلب</th>
          <th>عملکردها</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="article in articles" :key="article.id">
          <td>{{ article.title }}</td>
          <td>{{ article.body }}</td>
          <td>
            <a href="#" class="btn btn-primary" @click.prevent="showarticle(article)">مشاهده</a>

            <a href="#" class="btn btn-primary" @click.prevent="showEditForm(article)">ویرایش</a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  name: "ArticleList",

  data: () => ({
    articles: []
  }),

  props: {
    url: {
      type: String,
      default: ""
    }
  },

  computed: {
    /**
     * Check for records exists
     */
    hasRecord() {
      return (this.data || []).length;
    }
  },

  created() {
    console.log("article-list created");
  },

  mounted() {
    console.log("article-list mounted");
  },

  methods: {
    /**
     * Load articles
     */
    loadArticle() {
      axios.get(url).then(res => {
        this.articles = res.data;
      });
    }
  }
};
</script>

<style lang="sass" scoped>
    .my-row {
        border: 1px solid red;
    }
</style>
