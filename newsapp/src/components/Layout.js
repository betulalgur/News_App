import Link from 'next/link';

export default function Layout({ children }) {
    return (
        <div className="flex flex-col min-h-screen">
            <header className="bg-teal-950 text-white p-4">
                <Link href="/" legacyBehavior>
                    <h1 className="text-xl font-bold cursor-pointer">ALG NEWS</h1>
                </Link>
            </header>
            <main className="flex-1 p-4">
                {children}
            </main>
            <footer className="bg-teal-950  text-white p-4 text-center">
                © 2024 ALG NEWS, Inc.
            </footer>
        </div>
    );
}