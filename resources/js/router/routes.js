import QuestionsPage from '../pages/QuestionsPage'
import QuestionPage from '../pages/QuestionPage'
import MyPostsPage from '../pages/MyPostsPage'
import NotFoundPage from '../pages/NotFoundPage'

const routes = [
    {
        path: '/',
        component: QuestionsPage,
        name: 'home'
    },
    {
        path: '/questions',
        component: QuestionsPage,
        name: 'questions'
    },
    {
        path: '/my-posts',
        component: MyPostsPage,
        name: 'my-posts',
        meta: {
            requiresAuth: true
        }
    },
    {
        path: '/questions/:slug', 
        component: QuestionPage,
        name: 'questions.show'
    },
    {
        path: '*',
        component: NotFoundPage
    }
]

export default routes