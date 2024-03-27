import Layout from '../components/Layout';
import NewsList from '../components/NewsList';

export default function Home() {
    return (
        <Layout>
            <div className="container mx-auto px-4 py-8">
                <h1 className="text-4xl font-bold mb-8">Latest News</h1>
                <NewsList />
            </div>
        </Layout>
    );
}
