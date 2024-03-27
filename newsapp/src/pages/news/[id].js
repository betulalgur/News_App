import { useRouter } from 'next/router';
import Layout from '../../components/Layout';
import { useEffect, useState } from 'react';
import Pusher from 'pusher-js';

export default function NewsDetail() {
    const [newsItem, setNewsItem] = useState(null);
    const router = useRouter();
    const { id } = router.query;

    useEffect(() => {
        if (id) {
            fetch(`http://localhost:8000/api/news-items/${id}`)
                .then(response => response.json())
                .then(data => setNewsItem(data))
                .catch(error => console.error('Error fetching news item:', error));
        }

        // Setup Pusher
        const pusher = new Pusher('ee36af61ecd20dcc46d2', {
            cluster: 'eu',
            encrypted: true,
        });

        const channel = pusher.subscribe('news-item.' + id); // Assuming broadcasting on a specific channel per news item

        channel.bind('updated', (data) => {
            setNewsItem(data.newsItem);
        });

        return () => {
            channel.unbind();
            pusher.disconnect();
        };
    }, [id]);

    if (!newsItem) return <Layout>Loading or news item not found...</Layout>;
    return (
        <Layout>
            <div className="container mx-auto px-4 py-8">
                <button onClick={() => router.back()} className="mb-4 text-blue-500 hover:text-blue-700">
                    ← Back
                </button>
                <article className="max-w-4xl mx-auto">
                    <h1 className="text-4xl font-bold mb-4">{newsItem.title}</h1>
                    <div className="prose lg:prose-xl">
                        <p>{newsItem.content}</p>
                    </div>
                </article>
            </div>
        </Layout>
    );
}
