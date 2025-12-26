/** @type {import('tailwindcss').Config} */
export default {
    content: ["./resources/views/**/*.blade.php", "./resources/js/**/*.jsx"],
    theme: {
        extend: {
            colors: {
                primary: {
                    50: "#f0f5ff",
                    100: "#e0ebff",
                    500: "#3b82f6",
                    600: "#2563eb",
                    700: "#1d4ed8",
                    800: "#1e40af",
                },
                secondary: {
                    50: "#f8fafc",
                    100: "#f1f5f9",
                    500: "#64748b",
                    600: "#475569",
                },
            },
            fontFamily: {
                sans: ["Inter", "ui-sans-serif", "system-ui"],
            },
            boxShadow: {
                soft: "0 4px 6px -1px rgba(0, 0, 0, 0.05)",
                "md-soft": "0 10px 15px -3px rgba(0, 0, 0, 0.1)",
            },
            borderRadius: {
                xl: "1rem",
            },
            backgroundImage: {
                "gradient-sidebar":
                    "linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #ec4899 100%)",
                "gradient-primary":
                    "linear-gradient(to right, #4f46e5, #7c3aed)",
            },
        },
    },
    plugins: [],
};
