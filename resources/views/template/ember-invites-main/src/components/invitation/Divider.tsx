import divider from "@/assets/divider-gold.png";

export function Divider({ className = "" }: { className?: string }) {
  return (
    <div className={`flex justify-center ${className}`}>
      <img
        src={divider}
        alt=""
        aria-hidden="true"
        loading="lazy"
        className="h-16 md:h-20 w-auto opacity-80"
      />
    </div>
  );
}
