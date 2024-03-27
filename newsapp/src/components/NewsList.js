import Pusher from 'pusher-js';
import { useEffect, useState } from 'react';
import Link from 'next/link';

const NewsList = () => {
    const [newsItems, setNewsItems] = useState([]);

    useEffect(() => {
        fetch('http://localhost:8000/api/news-items')
            .then(response => response.json())
            .then(data => setNewsItems(data))
            .catch(error => console.error('Error fetching news items:', error));

        const pusher = new Pusher('ee36af61ecd20dcc46d2', {
            cluster: 'eu',
            encrypted: true,
        });

        const channel = pusher.subscribe('news');
        channel.bind('news-item-created', (data) => {
            setNewsItems(currentItems => [...currentItems, data.newsItem]);
        });

        return () => {
            channel.unbind();
            pusher.disconnect();
        };
    }, []);

    return (
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            {newsItems.map((item) => (
                <div key={item.id} className="border rounded-lg overflow-hidden shadow-lg p-4">
                    <Link href={`/news/${item.id}`} className="text-2xl font-semibold hover:text-blue-500">
                        {item.title}
                    </Link>
                    <p className="mt-2 text-gray-600">{item.summary}</p>
                </div>
            ))}
        </div>

    );
};

export default NewsList;
