import { createFileRoute } from "@tanstack/react-router";
import { useEffect, useState } from "react";
import { AnimatePresence, motion } from "framer-motion";
import { Toaster } from "sonner";
import { Cover } from "@/components/invitation/Cover";
import { MainContent } from "@/components/invitation/MainContent";

export const Route = createFileRoute("/")({
  head: () => ({
    meta: [
      { title: "Anindya & Reyhan — Undangan Pernikahan Digital" },
      {
        name: "description",
        content:
          "Undangan pernikahan digital Anindya & Reyhan. Sabtu, 15 Agustus 2026. Konfirmasi kehadiran & kirim ucapan.",
      },
      { property: "og:title", content: "Anindya & Reyhan — The Wedding" },
      {
        property: "og:description",
        content: "Dengan memohon rahmat-Nya, kami mengundang Anda di hari bahagia kami.",
      },
    ],
    links: [
      { rel: "preconnect", href: "https://fonts.googleapis.com" },
      { rel: "preconnect", href: "https://fonts.gstatic.com", crossOrigin: "anonymous" },
      {
        rel: "stylesheet",
        href: "https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&family=Great+Vibes&family=Inter:wght@400;500;600&display=swap",
      },
    ],
  }),
  component: Index,
});

function Index() {
  const [opened, setOpened] = useState(false);

  useEffect(() => {
    if (opened) {
      document.body.style.overflow = "auto";
      window.scrollTo({ top: 0, behavior: "instant" });
    } else {
      document.body.style.overflow = "hidden";
    }
  }, [opened]);

  return (
    <>
      <Toaster position="top-center" />
      <MainContent />
      <AnimatePresence>
        {!opened && (
          <motion.div
            key="cover"
            exit={{ opacity: 0, scale: 1.1, transition: { duration: 0.8 } }}
          >
            <Cover
              onOpen={() => setOpened(true)}
              names="A & R"
              date="Sabtu · 15 Agustus 2026"
            />
          </motion.div>
        )}
      </AnimatePresence>
    </>
  );
}
